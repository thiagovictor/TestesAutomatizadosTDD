<?php


namespace TDD\Interfaces;

interface FactoryInterface {
   public function createField($tipo, array $parametros = array());
}
