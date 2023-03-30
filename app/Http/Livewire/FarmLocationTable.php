<?php

namespace App\Http\Livewire;

use App\Models\Farm;
use App\Models\FarmLocation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class FarmLocationTable extends PowerGridComponent
{
    use ActionButton;
    public $farm_array = [];
    public $farm_name;
    public $f_id;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\FarmLocation>
     */
    public function datasource(): Builder
    {
        return FarmLocation::query()->where('active_status', "1");
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('farm_location')
            ->addColumn('farm_id')
            ->addColumn('farm_name');

        /** Example of custom column using a closure **/
        // ->addColumn('farm_location_lower', function (FarmLocation $model) {
        //     return strtolower(e($model->farm_location));
        // });

        // ->addColumn('created_at_formatted', fn (FarmLocation $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
        // ->addColumn('updated_at_formatted', fn (FarmLocation $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        $f_id = 'id';
        // $this->farm_name = Farm::findorfail($f_id);
        $this->farm_array = Farm::findorfail($f_id);
        [
            $this->farm_name,
        ] = [
            $this->farm_array->farm_name
        ];

        return [
            // Column::make('ID', 'id')
            //     ->makeInputRange(),

            Column::make('FARM LOCATION', 'farm_location')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),

            Column::make('FARM', 'farm_id')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),

            Column::make('FARM NAME', $f_id)
                ->sortable(),

            // Column::make('CREATED AT', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid FarmLocation Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('btn btn-primary cursor-pointer px-3 py-2 m-1 rounded text-sm')
                ->route('farm.l.show', ['id' => 'id']),

            Button::make('remove', 'Delete')
                ->class('btn btn-secondary cursor-pointer px-3 py-2 m-1 rounded text-sm')
                ->route('farm.l.remove', ['id' => 'id'])
                ->method('get')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid FarmLocation Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($farm-location) => $farm-location->id === 1)
                ->hide(),
        ];
    }
    */
}
