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
}
