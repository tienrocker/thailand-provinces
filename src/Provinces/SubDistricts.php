<?php

namespace Tienrocker\ThProvinces\Provinces;

class SubDistricts extends \Eloquent
{
    protected $sub_districts;

    protected $table;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('thprovinces.sub_districts_table');
    }

    /**
     * Get the SubDistricts from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getSubDistricts()
    {
        //Get the SubDistricts from the JSON file
        if (empty($this->sub_districts)) {
            $this->sub_districts = json_decode(file_get_contents(__DIR__ . '/../Models/sub_districts.json'), true);
        }

        //Return the SubDistricts
        return $this->sub_districts;
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
        $sub_districts = $this->getSubDistricts();
        return $sub_districts[$id];
    }

    /**
     * Returns a list of SubDistricts
     *
     * @param string $sort
     *
     * @return array
     */
    public function getList($sort = null)
    {
        //Get the SubDistricts list
        $sub_districts = $this->getSubDistricts();
        //Sorting
        $validSorts = [
            'id',
            'zip_code',
            'name_th',
            'name_en',
            'amphure_id'
        ];

        if (!is_null($sort) && in_array($sort, $validSorts)) {
            uasort($sub_districts, function ($a, $b) use ($sort) {
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

        //Return the SubDistricts
        return $sub_districts;
    }
}