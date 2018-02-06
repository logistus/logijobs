<?php

function generate_flash($type, $message) {
	session()->flash("type", $type);
    session()->flash("message",  $message);
}