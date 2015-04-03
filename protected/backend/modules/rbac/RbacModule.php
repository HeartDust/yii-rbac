<?php
class RbacModule extends CWebModule {
    public function init() {
        $this->setImport(array(
            'rbac.models.*',
        ));
    }
}