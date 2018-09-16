<?php

namespace Tienrocker\ThProvinces\Provinces;

class Geographies extends \Eloquent
{
    protected $geographies;

    protected $table;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('thprovinces.geographies_table');
    }

    /**
     * Get the geographies from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getGeographies()
    {
        //Get the geographies from the JSON file
        if (empty($this->geographies)) {
            $this->geographies = json_decode(file_get_contents(__DIR__ . '/../Models/geographies.json'), true);
        }

        //Return the geographies
        return $this->geographies;
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
        $geographies = $this->getGeographies();
        return $geographies[$id];
    }

    /**
     * Returns a list of geographies
     *
     * @param string $sort
     *
     * @return array
     */
    public function getList($sort = null)
    {
        //Get the geographies list
        $geographies = $this->getGeographies();
        //Sorting
        $validSorts = [
            'id',
            'name'
        ];

        if (!is_null($sort) && in_array($sort, $validSorts)) {
            uasort($geographies, function ($a, $b) use ($sort) {
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

        //Return the geographies
        return $geographies;
    }
}