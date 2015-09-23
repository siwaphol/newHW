<?php namespace App\Providers;

use App\HomeworkType;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		HomeworkType::creating(function($homeworktype){
			$last_homework_id = HomeworkType::max('id');
			$homeworktype->id = str_pad(++$last_homework_id,3,'0',STR_PAD_LEFT);
		});
        HomeworkType::saving(function($homeworktype){
            $last_homework_id = HomeworkType::max('id');
            $homeworktype->id = str_pad(++$last_homework_id,3,'0',STR_PAD_LEFT);
        });
	}

}
