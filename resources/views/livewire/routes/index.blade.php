<div>
   <div class="row mb-2">
      <div class="col-md-9">
         <label for="">Search</label>
         <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Enter route name">
      </div>
      <div class="col-md-3">
         <label for="">Items Per</label>
         <select wire:model="perPage" class="form-control">`
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
         </select>
      </div>
   </div>
   <div class="card card-default">
      <div class="card-body">
         <table class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th width="1%">#</th>
                  <th>Name</th>
                  <th>Customers</th>
                  <th>Sales People</th>
                  <th>Status</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($routes as $count=>$route)
                  <tr>
                     <td>{!! $count+1 !!}</td>
                     <td>{!! $route->name !!}</td>
                     <td>0</td>
                     <td>0</td>
                     <td>{!! $route->status !!}</td>
                     <td>{!! $route->start_date !!}</td>
                     <td>{!! $route->end_date !!}</td>
                     <td>
                        <a href="#" class="btn btn-warning btn-sm">View</a>
                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
         {!! $routes->links() !!}
      </div>
   </div>
</div>
