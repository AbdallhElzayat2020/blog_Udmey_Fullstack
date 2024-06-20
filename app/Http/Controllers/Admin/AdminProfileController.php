<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminProfileUpdateRequest;
    use App\Http\Requests\Admin\AdminUpdatePasswordRequest;
    use App\Models\Admin;
    use App\traits\FileUploadTrait;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use RealRashid\SweetAlert\Facades\Alert;

    class AdminProfileController extends Controller
    {
//        import from trait file
        use FileUploadTrait;

        public function index()
        {
            $user = Auth::guard('admin')->user();

            return view('admin.profile.index' , compact('user'));
        }

        public function update( AdminProfileUpdateRequest $request , string $id )
        {

            $imgPath = $this->handleFileUpload($request , 'image' , $request->old_image);

            $admin = Admin::findorFail($id);
            $admin->image = !empty($imgPath) ? $imgPath : $request->old_image;
            $admin->name = $request->name;
            $admin->email = $request->email;
//            toast('Your Profile as been Updated!' , 'success');
            Alert::success(__('Update Profile') , __('Your Profile as been Updated successfully'));

            $admin->save();

            return redirect()->back();

        }

        public function passwordUpdate( AdminUpdatePasswordRequest $request , $id )
        {

            if ( !Hash::check($request->current_password , Auth::guard('admin')->user()->password)) {
                throw  ValidationException::withMessages([ 'current_password' => __('The old password is not match') ]);
            }

            $admin = Admin::findorFail($id);
            $admin->password = bcrypt($request->password);

            Alert::success(__('Update Password') , __(__('Your Password as been Updated successfully')));

            $admin->save();

            return redirect()->back();
        }
    }
