<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\AttendanceModel;
use App\Models\WorkingDayLogModel;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;

/**
 * Class WorkingDayRecordService.
 */
class WorkingDayRecordService
{
    const ENTRY_COMPLETE = 'background: rgb(0,208,3);background: linear-gradient(121deg, rgba(0,208,3,1) 0%, rgba(18,171,23,1) 100%);';
    const ENTRY_INCOMPLETE = 'background: rgb(195,77,34);background: linear-gradient(333deg, rgba(195,77,34,1) 0%, rgba(253,153,45,1) 100%);';

    public static function deleteEntry($entryId){
        //Delete everyone from attendance
        $attendance = WorkerAttendanceService::getAllWorkersForEntry($entryId);
        foreach($attendance as $worker){
            WorkerAttendanceService::removeWorkerFromAttendance($worker->worker_id, $entryId);
        }

        //Delete entry self
        WorkingDayRecordModel::where('id', $entryId)->delete();
    }

    public static function isEntryComplete($elements){
        $isComplete = TRUE;
        foreach ($elements as $element) {
            if (!$element) {
                $isComplete = FALSE;
            }
        }
        if ($isComplete) {
            return [
                'isComplete' => TRUE,
                'cardStyle' => self::ENTRY_COMPLETE,
            ];
        }else{
            return [
                'isComplete' => FALSE,
                'cardStyle' => self::ENTRY_INCOMPLETE,
            ];
        }
    }

    public static function addNewLog($log, $entry){
        WorkingDayLogModel::create([
            'working_day_record_id' => $entry->id,
            'construction_site_id' => $entry->construction_site_id,
            'log' => $log,
        ]);

    }

    public static function getAllLogsForEntry($entry){
        return WorkingDayLogModel::where('working_day_record_id', $entry)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getLogById($id){
        return WorkingDayLogModel::where('id', $id)
            ->first();
    }

    public static function updateLog($logId, $newLog){
        WorkingDayLogModel::where('id', $logId)
            ->update([
                'log' => $newLog,
            ]);
    }

    public static function deleteLog($id){
        WorkingDayLogModel::where('id', $id)->delete();
    }

}