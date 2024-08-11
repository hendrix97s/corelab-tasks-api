<?php

namespace App\Repositories;


class Repository
{
  protected $model;

  public function __construct(string $model)
  {
    $this->model = new $model;
  }

  public function getModel()
  {
    return $this->model;
  }

  public function paginate(int $perPage = 25)
  {
    return $this->model->paginate($perPage);
  }

  public function get()
  {
    return $this->model->get();
  }

  public function getByWorkspace(int $workspaceId)
  {
    return $this->model->where('workspace_id', $workspaceId)->get();
  }

  public function paginateByWorkspace(int $workspaceId, int $perPage = 30)
  {
    return $this->model->where('workspace_id', $workspaceId)->paginate($perPage);
  }

  public function getByIds(array $ids)
  {
    return $this->model->whereIn('id', $ids)->get();
  }

  public function find(int $id)
  {
    return $this->model->find($id);
  }

  public function findBySlugAndWorkspace(string $slug, int $workspaceId)
  {
    return $this->model->where('workspace_id', $workspaceId)->where('slug', $slug)->first();
  }

  public function create(array $data)
  {
    return $this->model->create($data);
  }

  public function createByWorkspace(int $workspaceId, array $data)
  {
    $data['workspace_id'] = $workspaceId;
    return $this->model->create($data);
  }

  public function update(int $id, array $data)
  {
    $model = $this->model->find($id);
    if (!$model) return false;
    $model->update($data);
    return $model->fresh();
  }

  public function updateByIds(array $ids, array $data)
  {
    return $this->model->whereIn('id', $ids)->update($data);
  }

  public function delete(int $id)
  {
    return $this->model->destroy($id);
  }

  public function deleteByIds(array $ids)
  {
    return $this->model->whereIn('id', $ids)->delete();
  }
}
