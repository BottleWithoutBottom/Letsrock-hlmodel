<?php

namespace Birtock\Highload;
use Bitrock\HLModelTrait;
use Bitrix\Highloadblock\HighloadBlockTable;
use Letsrock\CreatableModel\CreatableModel;

abstract class HLModel implements CreatableModel
{
    use HLModelTrait;

    public CONST UF_ACTIVE = 'UF_ACTIVE';
    public CONST UF_SORT = 'UF_SORT';
    public CONST UF_XML_ID = 'UF_XML_ID';

    protected $hlEntity;
    protected static $HL_ID;

    protected function setHlEntity()
    {
        if (!empty($this->hlEntity) || empty(static::$HL_ID)) return false;

        $this->hlEntity = $this->getEntity();
        return true;
    }

    protected function getHlEntity()
    {
        if (empty($this->hlEntity)) $this->setHlEntity();

        return $this->hlEntity;
    }

    public function fetch($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        return $this->getHlEntity()::getList(
            [
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
            ]
        )->fetch();
    }

    public function fetchAll($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        return $this->getHlEntity()::getList(
            [
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
            ]
        )->fetchAll();
    }

    public function add($data)
    {
        if (empty($data)) return false;

        $entity = $this->getHlEntity();

        return $entity::add($data);
    }

    public function createByFactory(array $data)
    {
        return $this->add($data);
    }

    public function update($id, $data)
    {
        if (empty($id) || empty($data) || !is_array($data)) return false;

        return $this->getHlEntity()::update($id, $data);
    }

    private function getEntity()
    {
        \CModule::IncludeModule('highloadblock');
        $hlblock = HighloadBlockTable::getById(static::$HL_ID)->fetch();
        $entity = HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }
}