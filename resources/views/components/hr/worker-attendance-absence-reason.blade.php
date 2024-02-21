<div>
    @if ($row->absence_reason)
        {{ App\Models\AttendanceModel::ABSENCE_REASON_SHT_TXT[$row->absence_reason] }}   
    @endif
</div>