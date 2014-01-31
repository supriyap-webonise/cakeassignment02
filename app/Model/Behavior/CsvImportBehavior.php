<?php
class CsvImportBehavior extends ModelBehavior
{
    public function setup(Model $Model, $settings = array()) {

    }

//import csv file data after uploading
    public function importData(Model $Model,$filename)
    {
        // to avoid having to tweak the contents of
        // $data you should use your db field name as the heading name

        // open the file
        $handle = fopen($filename, "r");

        // read the 1st row as headings
        $header = fgetcsv($handle);

        // create a message container
        $return = array(
            'messages' => array(),
            'errors' => array(),
        );
        $i=0;
        // read each data row in the file
        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();

            // for each header field
            foreach ($header as $k=>$head) {
                // get the data field from Model.field
                if (strpos($head,'.')!==false) {
                    $h = explode('.',$head);
                    $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                }
                // get the data field from field
                else {
                    $data['Employee'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
            }

            // see if we have an id
            $id = isset($data['Employee']['id']) ? $data['Employee']['id'] : 0;
            $name = isset($data['Employee']['name']) ? $data['Employee']['name'] : '';

            if($name)
            {
                // we have an id, so we update
                if ($id) {
                    // set the model id
                    $Model->id = $id;
                }

                // or create a new record
                else {
                    $Model->create();
                }

                // validate the row
                $Model->set($data);
                if (!$Model->validates()) {
                    $return['errors'][] = __(sprintf('Post for Row %d failed to validate.',$i), true);
                }
                // save the row
                if (!$Model->save($data)) {
                    $return['errors'][] = __(sprintf('Post for Row %d failed to save.',$i), true);
                }

                // success message!
                if (empty($return['errors'])) {
                    $return['messages'][] = __(sprintf('Post for Row %d was saved.',$i), true);
                }
            }
        }
        // close the file
        fclose($handle);

        // return the messages
        return $return;

    }
}
