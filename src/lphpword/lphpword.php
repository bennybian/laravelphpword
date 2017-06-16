<?php namespace lphpword;

/**
 *
 * Laravel wrapper for PHPWord
 *
 * @category   Laravel Excel
 * @version    1.0.0
 * @package    maatwebsite/excel
 * @copyright  Copyright (c) 2013 - 2014 Maatwebsite (http://www.maatwebsite.nl)
 * @author     Maatwebsite <info@maatwebsite.nl>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Lphpword {

    /**
     * Filter
     * @var array
     */
    protected $filters = array(
        'registered' =>  array(),
        'enabled'    =>  array()
    );

    /**
     * Excel object
     * @var PHPExcel
     */
    protected $excel;

    /**
     * Reader object
     * @var LaravelExcelReader
     */
    protected $reader;

    /**
     * Writer object
     * @var LaravelExcelWriter
     */
    protected $writer;

    /**
     * Construct Excel
     * @param  PHPExcel           $excel
     * @param  LaravelExcelReader $reader
     * @param  LaravelExcelWriter $writer
     */
    public function __construct(PHPExcel $excel, LaravelExcelReader $reader, LaravelExcelWriter $writer)
    {
        // Set Excel dependencies
        $this->excel = $excel;
        $this->reader = $reader;
        $this->writer = $writer;
		echo "loaded";
    }

    /**
     * Create a new file
     * @param                $filename
     * @param  callable|null $callback
     * @return LaravelExcelWriter
     */
    public function create($filename, $callback = null)
    {}

  }
