@if($count > 0)
    <div class="text-red-600">
        {{ trans_choice('common.status.active_problems', $count) }}
    </div>
@endif