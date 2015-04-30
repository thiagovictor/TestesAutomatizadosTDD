<?php

namespace TDD\Interfaces;

interface ValidadorInterface {

    public function isValid($data);

    public function getFor();

    public function getMessageError();
}
