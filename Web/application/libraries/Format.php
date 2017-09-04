<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format {
    const ARRAY_FORMAT = 'array';
    const CSV_FORMAT = 'csv';
    const JSON_FORMAT = 'json';
    const HTML_FORMAT = 'html';
    const PHP_FORMAT = 'php';
    const SERIALIZED_FORMAT = 'serialized';
    const XML_FORMAT = 'xml';
    const DEFAULT_FORMAT = self::JSON_FORMAT;

    private $_CI;

    protected $_data = [];
    protected $_from_type = NULL;

    public function __construct($data = NULL, $from_type = NULL) {
        $this->_CI = &get_instance();
        $this->_CI->load->helper('inflector');

        if($from_type !== NULL) {
            if(method_exists($this, '_from_'.$from_type)) {
                $data = call_user_func([$this, '_from_'.$from_type], $data);
            } else {
                throw new Exception('Format class does not support conversion from "'.$from_type.'".');
            }
        }

        $this->_data = $data;
    }

    public function factory($data, $from_type = NULL) {
        return new static($data, $from_type);
    }

    public function to_array($data = NULL) {
        if($data === NULL && func_num_args() === 0) {
            $data = $this->_data;
        }

        if(is_array($data) === FALSE) {
            $data = (array) $data;
        }

        $array = [];
        foreach((array) $data as $key => $value) {
            if(is_object($value) === TRUE || is_array($value) === TRUE) {
                $array[$key] = $this->to_array($value);
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    public function to_xml($data = NULL, $structure = NULL, $basenode = 'xml') {
        if($data === NULL && func_num_args() === 0) {
            $data = $this->_data;
        }

        if($structure === NULL) {
            $structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
        }

        if(is_array($data) === FALSE && is_object($data) === FALSE) {
            $data = (array) $data;
        }

        foreach($data as $key => $value) {
            if(is_bool($value)) {
                $value = (int) $value;
            }

            if(is_numeric($key)) {
                $key = (singular($basenode) != $basenode) ? singular($basenode) : 'item';
            }

            // replace anything not alpha numeric
            $key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

            if ($key === '_attributes' && (is_array($value) || is_object($value)))
            {
                $attributes = $value;
                if (is_object($attributes))
                {
                    $attributes = get_object_vars($attributes);
                }

                foreach ($attributes as $attribute_name => $attribute_value)
                {
                    $structure->addAttribute($attribute_name, $attribute_value);
                }
            }
            // if there is another array found recursively call this function
            elseif (is_array($value) || is_object($value))
            {
                $node = $structure->addChild($key);

                // recursive call.
                $this->to_xml($value, $node, $key);
            }
            else
            {
                // add single node.
                $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');

                $structure->addChild($key, $value);
            }
        }

        return $structure->asXML();
    }

    /**
     * Format data as HTML
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return mixed
     */
    public function to_html($data = NULL)
    {
        // If no data is passed as a parameter, then use the data passed
        // via the constructor
        if ($data === NULL && func_num_args() === 0)
        {
            $data = $this->_data;
        }

        // Cast as an array if not already
        if (is_array($data) === FALSE)
        {
            $data = (array) $data;
        }

        // Check if it's a multi-dimensional array
        if (isset($data[0]) && count($data) !== count($data, COUNT_RECURSIVE))
        {
            // Multi-dimensional array
            $headings = array_keys($data[0]);
        }
        else
        {
            // Single array
            $headings = array_keys($data);
            $data = [$data];
        }

        // Load the table library
        $this->_CI->load->library('table');

        $this->_CI->table->set_heading($headings);

        foreach ($data as $row)
        {
            // Suppressing the "array to string conversion" notice
            // Keep the "evil" @ here
            $row = @array_map('strval', $row);

            $this->_CI->table->add_row($row);
        }

        return $this->_CI->table->generate();
    }

    /**
     * @link http://www.metashock.de/2014/02/create-csv-file-in-memory-php/
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @param string $delimiter The optional delimiter parameter sets the field
     * delimiter (one character only). NULL will use the default value (,)
     * @param string $enclosure The optional enclosure parameter sets the field
     * enclosure (one character only). NULL will use the default value (")
     * @return string A csv string
     */
    public function to_csv($data = NULL, $delimiter = ',', $enclosure = '"')
    {
        // Use a threshold of 1 MB (1024 * 1024)
        $handle = fopen('php://temp/maxmemory:1048576', 'w');
        if ($handle === FALSE)
        {
            return NULL;
        }

        // If no data is passed as a parameter, then use the data passed
        // via the constructor
        if ($data === NULL && func_num_args() === 0)
        {
            $data = $this->_data;
        }

        // If NULL, then set as the default delimiter
        if ($delimiter === NULL)
        {
            $delimiter = ',';
        }

        // If NULL, then set as the default enclosure
        if ($enclosure === NULL)
        {
            $enclosure = '"';
        }

        // Cast as an array if not already
        if (is_array($data) === FALSE)
        {
            $data = (array) $data;
        }

        // Check if it's a multi-dimensional array
        if (isset($data[0]) && count($data) !== count($data, COUNT_RECURSIVE))
        {
            // Multi-dimensional array
            $headings = array_keys($data[0]);
        }
        else
        {
            // Single array
            $headings = array_keys($data);
            $data = [$data];
        }

        // Apply the headings
        fputcsv($handle, $headings, $delimiter, $enclosure);

        foreach ($data as $record)
        {
            // If the record is not an array, then break. This is because the 2nd param of
            // fputcsv() should be an array
            if (is_array($record) === FALSE)
            {
                break;
            }

            // Suppressing the "array to string conversion" notice.
            // Keep the "evil" @ here.
            $record = @ array_map('strval', $record);

            // Returns the length of the string written or FALSE
            fputcsv($handle, $record, $delimiter, $enclosure);
        }

        // Reset the file pointer
        rewind($handle);

        // Retrieve the csv contents
        $csv = stream_get_contents($handle);

        // Close the handle
        fclose($handle);
        
        // Convert UTF-8 encoding to UTF-16LE which is supported by MS Excel
        $csv = mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');

        return $csv;
    }

    /**
     * Encode data as json
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return string Json representation of a value
     */
    public function to_json($data = NULL)
    {
        // If no data is passed as a parameter, then use the data passed
        // via the constructor
        if ($data === NULL && func_num_args() === 0)
        {
            $data = $this->_data;
        }

        // Get the callback parameter (if set)
        $callback = $this->_CI->input->get('callback');

        if (empty($callback) === TRUE)
        {
            return json_encode($data);
        }

        // We only honour a jsonp callback which are valid javascript identifiers
        elseif (preg_match('/^[a-z_\$][a-z0-9\$_]*(\.[a-z_\$][a-z0-9\$_]*)*$/i', $callback))
        {
            // Return the data as encoded json with a callback
            return $callback.'('.json_encode($data).');';
        }

        // An invalid jsonp callback function provided.
        // Though I don't believe this should be hardcoded here
        $data['warning'] = 'INVALID JSONP CALLBACK: '.$callback;

        return json_encode($data);
    }

    /**
     * Encode data as a serialized array
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return string Serialized data
     */
    public function to_serialized($data = NULL)
    {
        // If no data is passed as a parameter, then use the data passed
        // via the constructor
        if ($data === NULL && func_num_args() === 0)
        {
            $data = $this->_data;
        }

        return serialize($data);
    }

    /**
     * Format data using a PHP structure
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return mixed String representation of a variable
     */
    public function to_php($data = NULL)
    {
        // If no data is passed as a parameter, then use the data passed
        // via the constructor
        if ($data === NULL && func_num_args() === 0)
        {
            $data = $this->_data;
        }

        return var_export($data, TRUE);
    }

    // INTERNAL FUNCTIONS

    /**
     * @param string $data XML string
     * @return array XML element object; otherwise, empty array
     */
    protected function _from_xml($data)
    {
        return $data ? (array) simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA) : [];
    }

    /**
     * @param string $data CSV string
     * @param string $delimiter The optional delimiter parameter sets the field
     * delimiter (one character only). NULL will use the default value (,)
     * @param string $enclosure The optional enclosure parameter sets the field
     * enclosure (one character only). NULL will use the default value (")
     * @return array A multi-dimensional array with the outer array being the number of rows
     * and the inner arrays the individual fields
     */
    protected function _from_csv($data, $delimiter = ',', $enclosure = '"')
    {
        // If NULL, then set as the default delimiter
        if ($delimiter === NULL)
        {
            $delimiter = ',';
        }

        // If NULL, then set as the default enclosure
        if ($enclosure === NULL)
        {
            $enclosure = '"';
        }

        return str_getcsv($data, $delimiter, $enclosure);
    }

    /**
     * @param string $data Encoded json string
     * @return mixed Decoded json string with leading and trailing whitespace removed
     */
    protected function _from_json($data)
    {
        return json_decode(trim($data));
    }

    /**
     * @param string $data Data to unserialize
     * @return mixed Unserialized data
     */
    protected function _from_serialize($data)
    {
        return unserialize(trim($data));
    }

    /**
     * @param string $data Data to trim leading and trailing whitespace
     * @return string Data with leading and trailing whitespace removed
     */
    protected function _from_php($data)
    {
        return trim($data);
    }
}
