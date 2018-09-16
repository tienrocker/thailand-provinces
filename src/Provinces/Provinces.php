<?php

namespace Tienrocker\ThProvinces\Provinces;

class Provinces extends \Eloquent
{
    protected $provinces;

    protected $table;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('thprovinces.provinces_table');
    }

    /**
     * Get the provinces from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getProvinces()
    {
        //Get the provinces from the JSON file
        if (empty($this->provinces)) {
            $this->provinces = json_decode(file_get_contents(__DIR__ . '/../Models/provinces.json'), true);
        }

        //Return the provinces
        return $this->provinces;
    }

    /**
     * Returns one province
     *
     * @param string $id The province id
     *
     * @return array
     */
    public function getOne($id)
    {
        $provinces = $this->getProvinces();
        return $provinces[$id];
    }

    /**
     * Returns a list of provinces
     *
     * @param string $sort
     *
     * @return array
     */
    public function getList($sort = null)
    {
        //Get the provinces list
        $provinces = $this->getProvinces();
        //Sorting
        $validSorts = [
            'id',
            'code',
            'name_en',
            'name_th',
            'geography_id'
        ];

        if (!is_null($sort) && in_array($sort, $validSorts)) {
            uasort($provinces, function ($a, $b) use ($sort) {
                if (!isset($a[$sort]) && !isset($b[$sort])) {
                    return 0;
                } elseif (!isset($a[$sort])) {
                    return -1;
                } elseif (!isset($b[$sort])) {
                    return 1;
                } else {
                    return strcasecmp($a[$sort], $b[$sort]);
                }
            });
        }

        //Return the provinces
        return $provinces;
    }
}