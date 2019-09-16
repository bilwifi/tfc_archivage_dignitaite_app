<?php

namespace App\DataTables;

use App\Models\Dignitaire;
use Yajra\DataTables\Services\DataTable;

class ListDignitairesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($query){
                $btn = " ";
                if (auth()->check()) {
                    $btn = '<a href="'.route('show_dignitaire',$query->iddignitaires).'" class="btn btn-primary text-monospace"><span class="fa fa-eye"></span>Ajouter</a>';
                }
                return '<a href="'.route('show_dignitaire',$query->iddignitaires).'" class="btn btn-primary text-monospace"><span class="fa fa-eye"></span>Afficher</a> ';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dignitaire $model)
    {
        return $model::get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '100px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'id',
            'nom',
            // 'postnom',
            'prenom',
            'fonction',
            
        ];
    }
    protected function getBuilderParameters(){
        return [
            'dom' => 'ftp',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ListDignitaires_' . date('YmdHis');
    }
}
