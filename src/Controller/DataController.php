<?php
namespace App\Controller;


use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Data Controller
 *
 * @property \App\Model\Table\DataTable $Data
 *
 * @method \App\Model\Entity\Data[] paginate($object = null, array $settings = [])
 */
class DataController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data = $this->paginate($this->Data);

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Data id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $data = $this->Data->get($id, [
            'contain' => []
        ]);

        $this->set('data', $data);
        $this->set('_serialize', ['data']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->Data->newEntity();
        if ($this->request->is('post')) {
            $data = $this->Data->patchEntity($data, $this->request->getData());
            if ($this->Data->save($data)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Data id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Data->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Data->patchEntity($data, $this->request->getData());
            if ($this->Data->save($data)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Data id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Data->get($id);
        if ($this->Data->delete($data)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	/**
	 * Import method 
	 *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	 
	public function import()
	{
		$uploadData = '';
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		if ($this->request->is('post'))
		{
			if(!empty($this->request->data['file']['name']))
			{
				$filetype = $this->request->data['file']['type'];
				if(!in_array($filetype,$mimes)) echo 'Only CSV files may be uploaded';
				else
				{
					$filename = $this->request->data['file']['name'];
					$uploadPath = 'uploads/files/';
					$uploadFile =  $uploadPath . $filename;
					if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile))
					{
						$handle = fopen($uploadFile, 'r');
						while (($csvarray = fgetcsv($handle)) !==FALSE)
						{
							$data = $this->Data->newEntity();
							$data->title = $csvarray['0'];
							$data->body = $csvarray['1'];
							$data->item_code = $csvarray['2'];
							$data->created = date('Y-m-d H:i:s');
							$data->modified = date('Y-m-d H:i:s');
							if(!$this->Data->save($data))
							{
								$this->Flash->error(__('The data could not be saved. Please, try again.'));
							}
						}
						return $this->redirect(['action' => 'index']);
					}
				}
			}
		}
	}
}
