function buildUrl(url, parameters) {
    let qs = "";
    for (const key in parameters) {
        if (parameters.hasOwnProperty(key)) {
            const value = parameters[key];
            qs +=
                encodeURIComponent(key) + "=" + encodeURIComponent(value) + "&";
        }
    }
    if (qs.length > 0) {
        qs = qs.substring(0, qs.length - 1); //chop off last "&"
        url = url + "?" + qs;
    }

    return url;
}

var RevealExecute = window.RevealExecute = (function() {
    return {
        id: 'execute',
        init: function (deck) {
            let element;
            let container = document.getElementById('script-result');
            let output = document.getElementById('script-result-output');
            let indicator = document.getElementById('script-indicator');
            let opened = false;

            function setup(event) {
                indicator.classList.add('hidden');
                container.classList.add('hidden');
                output.innerHTML = '';
                opened = false;
                element = null;
                const nodes = event.currentSlide.querySelectorAll('[data-filename]');

                if (nodes.length > 0) {
                    element = nodes[0];
                    indicator.classList.remove('hidden');
                }
            }

            Reveal.addEventListener('slidechanged', setup);
            Reveal.addEventListener('ready', setup);

            const fetchResult = () => {
                if (!element || !element.hasAttribute('data-filename')) return;

                let script = element.getAttribute('data-filename');
                fetch(buildUrl('http://localhost:8080/execute', {
                    bin: 'php',
                    script: `scripts/${script}`,
                }), {
                    method: 'GET',
                    mode: 'cors',
                    headers: {
                        "Accept": "plain/text"
                    }
                })
                    .then(resp => resp.text())
                    .then(response => {
                        console.log(response);
                        output.innerText = response;
                        container.classList.remove('hidden');
                    });
            };

            deck.addKeyBinding( { keyCode: 190, key: '.'}, () => {
                if (!element) return;

                if (opened === false) {
                    opened = true;
                    output.innerHTML = '';
                    fetchResult();
                } else {
                    opened = false;
                    container.classList.add('hidden');
                }
            });
        }
    }
});
