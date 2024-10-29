<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notifications;
use App\Models\ConstructionSiteModel;
use App\Models\MaterialMasterData;
use App\Services\HidroProjekt\Domain\Order\InternalOrder\InternalOrderService;

class SystemNotificationMoreModal extends Component
{
    public $show = FALSE;
    public $data = NULL;
    public $title = NULL;
    public $mainData = NULL;

    #[On('open-system-notification-more-modal')]
    public function toggleModal($data = NULL){
        $this->data = $data;
        if($this->data){
            $this->title = Notifications::TYPES_INFO[$this->data['type']]['name'];
            $this->setMainDataForModal();
        }
        $this->show = $this->show == FALSE ? TRUE : FALSE;
        return;
    }

    private function setMainDataForModal(){
        $this->mainData = NULL;
        switch ($this->data['type']) {
            case 'int_order':
                $order = new InternalOrderService;
                $value = json_decode($this->data['value'], true);
                $order->getOrderById($value['order_id']);
                $jobSiteName = ConstructionSiteModel::where('id', $order->getOrder()->const_id)->first()->name;
                $orderedBy = User::where('id', $order->getOrder()->ordered_by)->with('getWorker')->first()->getWorker->fullName;
                $orderItems = [];
                foreach ($order->getOrderItems() as $item) {
                    $orderItems[]=[
                        'mat_name' => MaterialMasterData::where('id', $item->mat_id)->first()->name,
                        'qty' => $item->qty,
                    ];
                }
                $this->mainData=[
                    'jobSiteName' => $jobSiteName,
                    'orderedBy' => $orderedBy,
                    'orderItems' => $orderItems,
                    'remark' => $order->getOrder()->remark,
                ];
                break;
            
            default:
                # code...
                break;
        }
    }

    public function render()
    {
        return view('livewire.system-notification-more-modal');
    }
}
