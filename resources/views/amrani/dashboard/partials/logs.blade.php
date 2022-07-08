<div class="border rounded-lg p-2 bg-white shadow mb-4">
    <div class="flex items-center justify-between h-12 px-4 text-gray-600">
        <h1 class="font-bold text-lg">Activités</h1>
        <button class="text-blue-400 p-2 hover:text-gray-600"><i class="fas fa-sync-alt"></i></button>
    </div>
    @foreach ($activities as $log)
        <div class="flex items-center justify-between bg-white border-b py-2 px-4">
            <p class="text-xs">
                @php
                   switch($log->subject_type){
                        case 'App\Models\Client':
                            echo isset($log->subject->client_name)?$log->subject->client_name: 'deleted';
                           break;
                       
                       default:
                            echo $log->description;
                            break;
                   }
                @endphp
            </p>
            <p class="text-xs font-bold">
                {{$log->created_at->diffForHumans()}}
            </p>
        </div>                        
    @endforeach
    <div class="text-center">
        <a href="{{ route('activity.log') }}" class="text-blue-400 pt-4 px-4 block text-sm">Voir Tous</a>
    </div>
</div>