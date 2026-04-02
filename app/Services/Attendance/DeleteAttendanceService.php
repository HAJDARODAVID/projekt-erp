<?php

namespace App\Services\Attendance;

use App\Models\AttendanceCoOpModel;
use App\Models\Employees\Attendance;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CreateAttendanceService.php.
 */
class DeleteAttendanceService extends BaseService
{
    /**
     * Attendance data from my employees or cooperators.
     * 
     * @var Collation|Attendance|AttendanceCoOpModel
     */
    private $attendance;

    public function __construct(Collection|Attendance|AttendanceCoOpModel $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Execute this service.
     * 
     * @return $this
     */
    public function execute(): self
    {
        try {
            if ($this->attendance instanceof Collection) {
                foreach ($this->attendance as $attItem) {
                    $attItem->delete();
                }
            } else {
                $this->attendance->delete();
            }
        } catch (\Throwable $th) {
            $this->setErrorMessage($th->getMessage());
        }
        $this->setSuccessMessage('Attendance successfully deleted!');
        return $this;
    }

    /**
     * Creates the service by the attendance id.
     * 
     * @return DeleteAttendanceService
     */
    public static function byID($id, $type = 'myWorkers'): self
    {
        $attendance = null;
        switch ($type) {
            case 'myWorkers':
                $attendance = Attendance::find($id);
                break;
            case 'co-op':
                $attendance = AttendanceCoOpModel::find($id);
                break;
        }
        return new self($attendance);
    }
}
