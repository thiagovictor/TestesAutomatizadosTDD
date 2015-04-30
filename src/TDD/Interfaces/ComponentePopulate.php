<?php

namespace TDD\Interfaces;

interface ComponentePopulate {

    public function setValue($value);

    public function getName();

    public function getValue();

    public function setErro($mensagem);
}
