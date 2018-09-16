<?php

namespace Tienrocker\ThProvinces\Provinces;

class Districts extends \Eloquent
{
    protected $districts;

    protected $table;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('thprovinces.districts_table');
    }

    /**
     * Get the districts from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getDistricts()
    {
        //Get the districts from the JSON file
        if (empty($this->districts)) {
            $this->districts = json_decode(file_get_contents(__DIR__ . '/../Models/districts.json'), true);
        }

        //Return the districts
        return $this->districts;
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
        $districts = $this->getDistricts();
        return $districts[$id];
    }

    /**
     * Returns a list of districts
     *
     * @param string $sort
     *
     * @return array
     */
    public function getList($sort = null)
    {
        //Get the districts list
        $districts = $this->getDistricts();
        //Sorting
        $validSorts = [
            'id',
            'code',
            'name_th',
            'name_en',
            'province_id'
        ];

        if (!is_null($sort) && in_array($sort, $validSorts)) {
            uasort($districts, function ($a, $b) use ($sort) {
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

        //Return the districts
        return $districts;
    }
}