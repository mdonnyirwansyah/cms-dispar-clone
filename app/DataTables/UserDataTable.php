<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('roles', function ($data) {
                return $data->roles()->get()->implode('name', ', ');
            })
            ->addColumn('action', function ($data) {
                if ($data->id == Auth::user()->id) {
                    $display = 'd-none';
                } else {
                    $display = '';
                }

                return '
                    <button onClick="editRecord('.$data->id.')" id="edit-'.$data->id.'" edit-route="'.route('users.edit', $data).'" class="btn btn-icon">
                        <i class="fas fa-pen text-info"></i>
                    </button>
                    <button onClick="deleteRecord('.$data->id.')" id="delete-'.$data->id.'" delete-route="'.route('users.destroy', $data).'" class="btn btn-icon '.$display.'">
                        <i class="fas fa-trash text-danger"></i>
                    </button>
                ';
            })
            ->editColumn('created_at', function ($data) { 
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); 

                return $formatedDate; 
            })
            ->editColumn('updated_at', function ($data) { 
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('Y-m-d H:i:s'); 

                return $formatedDate; 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width(50),
            Column::make('email'),
            Column::make('name'),
            Column::computed('roles'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')->width(85),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
