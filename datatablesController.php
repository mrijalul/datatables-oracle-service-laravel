<?php
class DatatablesController extends Controller
{
	public function getAllData(Request $request)
	{
		DB::statement(DB::raw('set @rownum=0'));
		// cek ajax request   
		if($request->json()){
			$data = Modelnya::select([
				DB::raw('@rownum  := @rownum  + 1 AS rownum'),
				'id','field1','field2','field3','field4','created_at'
			]);
			$datatables = Datatables::of($data);
			if ($keyword = $request->get('search')['value']) {
				$datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
			}
			return $datatables->addColumn('action', function ($data) {
				return '<div class="btn-group">
					<form action="'.route('admin.data.destroy',$data->id).'" method="POST" accept-charset="UTF-8" class="form-inline delete_form">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="'.csrf_token().'">
						<button type="submit" id="delete-btn" class="btn btn-xs btn-danger delete-link" name="delete_modal">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</button>
					</form>
				</div>';
			})
			->editColumn('created_at', function ($data) {
				return $data->created_at ? with(new Carbon($data->created_at))->format('Y-m-d H:i:s') : '';
			})
			->make(true);
		} else {
			exit("<h1 style='font-size: 227px;'>Sorry data not found :p</h1>");
		}
	}
}