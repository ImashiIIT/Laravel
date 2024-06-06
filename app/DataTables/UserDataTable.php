<?php
namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('role', function(User $user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->addColumn('action', function($user) {
                $editUrl = route('users.edit', $user->id);
                $deleteUrl = route('users.destroy', $user->id);
                $csrfToken = csrf_token();

                return <<<HTML
                    <a href="{$editUrl}" class="btn btn-success btn-sm">Edit</a>
                    <form action="{$deleteUrl}" method="POST" style="display: inline;">
                        <input type="hidden" name="_token" value="{$csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
HTML;
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        // Eager load the roles relationship
        return $model->newQuery()->with('roles');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('role'), // Add this column
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}