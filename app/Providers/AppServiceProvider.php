<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Area;
use App\project;
use App\Flat;
use App\Customer;
use App\Rent;
use App\RentCollection;
use App\Expense;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.master', 'App\Http\Composers\MasterComposer');
        
        Area::deleted(
            function ($area) {
                $area->projects()->delete();
            }
        );

        project::deleted(
            function ($project) {
                $project->flats()->delete();
                $project->expenses()->delete();
                $project->rents()->delete();
            }
        );

        Flat::deleted(
            function ($flat) {
                $flat->rents()->delete();
            }
        );

        Customer::deleted(
            function ($customer) {
                $customer->rents()->delete();
                $customer->collections()->delete();
            }
        );
        Rent::deleted(
            function ($rent) {
                $rent->collections()->delete();
            }
        );

        //        project::restored(function($project) {
        //            $project->services()->withTrashed()->restore();
        //        });

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
