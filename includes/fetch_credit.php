<?php

function fetch_credit() {
    return rand(60, 100);
}

function amount_from_request() {
    return fetch_credit();
}