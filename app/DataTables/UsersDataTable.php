<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

        // date - created_at
        ->addColumn('created_at', function($query){
            $date = date( 'd M Y', strtotime($query->created_at) );
            return $date;
        })

        // date - updated_at
        ->addColumn('updated_at', function($query){
            $date = date( 'd M Y', strtotime($query->updated_at) );
            return $date;
        })

        // date - email_verified_at
        ->addColumn('email_verified_at', function($query){
            $date = date( 'd M Y', strtotime($query->email_verified_at) );
            return $date;
        })


        // action
        ->addColumn('action', function($query){

            // $view = "<a href='".route('admin.orders.show', $query->id)."' class='btn btn-primary'><i class='fas fa-eye'></i></a>";

            $view = "<a href='#' class='btn btn-primary'><i class='fas fa-eye'></i></a>";

            $delete = "<a href='#' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";

            return $view . $delete;
        })

        ->rawColumns(['action'])

        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
                    ->parameters([

                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'pageLength', 'print', 'reset', 'reload'],
                        'select'       => false,
                        'order'        => [[0, 'asc']],

                        // 'pageLength'   => 10,

                        // Configure the drop down options.
                        'lengthMenu'   => [
                                            [ 10, 25, 50, -1 ],
                                            [ '10 filas', '25 filas', '50 filas', 'Todos' ]
                                        ],
                        
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id'),

            Column::make('name')->title(__('Nombre')),
            Column::make('email')->title(__('Correo')),

            Column::make('created_at')->title(__('Creado')),
            Column::make('updated_at')->title(__('Actualizado')),
            Column::make('email_verified_at')->title(__('Verificado')),

            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->title(__('Acción'))
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
