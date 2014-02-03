<?php
class EmployeesController extends AppController
{

    public function index()
    {
        $this->Employee->recursive = 0;
    }
    //import employee csv file to mysql table
    public function uploademployee()
    {
        if($this->request->is('post'))
        {
            if($this->request->data['Employee']['upload_file']['error']==4)
            {
                unset($this->request->data['Employee']['upload_file']);
            }
            else
            {
                $filename = basename($this->request->data['Employee']['upload_file']['name']);
                if(move_uploaded_file($this->data['Employee']['upload_file']['tmp_name'],WWW_ROOT . DS . 'uploads' . DS . $filename))
                {
                $this->request->data['Employee']['upload_file'] = $this->request->data['Employee']['upload_file']['name'];
                    $message = $this->Employee->importData(WWW_ROOT . DS . 'uploads' . DS . $filename);
                    if(empty($message['errors']))
                        $this->set('successmessage','Saved Successfully');
                    else
                        $this->set('errormessage','Error While Saving Data');
                }
                else
                {
                    $this->Session->setFlash(__("Unable to upload file..."));
                }

            }
        }
    }
    public function download()
    {
        $this->autoRender = false;
        $filename = WWW_ROOT .'uploads' . DS.'osemployee';
       /* header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');*/
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename.csv\";" );

        print $content;
        /*$this->view = 'Media';
        $params = array(
            'id' => 'osemployee.csv',
            'name' => 'osemployee',
            'mimeType' => 'text/csv csv',
            'download' => true,
            'extension' => 'csv',
            'path' => WWW_ROOT . DS . 'uploads' . DS
        );

        $this->set($params);*/
        $this->autoLayout = false;
    }
}

