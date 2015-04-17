<?php

namespace Model\Modules;

interface Imodule {

    public function getIncludedModules();
    public function getModuleData();
    public function setModuleData();
}
