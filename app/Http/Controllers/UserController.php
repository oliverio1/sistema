<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserFiles;
use Spatie\Permission\Models\Role;
use Hash;
use DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::where('type',1)->get();
        return view('admin.users.index', compact('users'));
    }
    
    public function create() {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'initials' => 'required',
            'roles' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => '1',
            'status' => '1',
        ]);
        $user->roles()->sync($request->roles);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:jpg,png|max:30000'
            ]);
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/usuarios/images', $filename);
        } else {
            $filename = 'sinimagen.png';
        }
        if ($request->hasFile('signature')){
            $Validation = $request->validate([
                'signature' => 'required|file|mimes:jpg,png|max:30000'
            ]);
            $file = $Validation['signature'];
            $signature = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/usuarios/signatures', $signature);
        } else {
            $signature = 'sinimagen.png';
        }
        $info['user_id'] = $user->id;
        $info['address'] = $request->address;
        $info['initials'] = $request->initials;
        $info['phone'] = $request->phone;
        $info['emergency_phone'] = $request->emergency_phone;
        $info['emergency_contact'] = $request->emergency_contact;
        $info['position'] = $request->position;
        $info['profile_image'] = $filename;
        $info['signature'] = $signature;
        $info['status'] = 1;
        DB::table('user_details')->insert($info);
        return redirect()->route('users.index')->with('info','Usuario guardado exitosamente');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        $acta = UserFiles::where('user_id',$id)->where('document','Acta')->first();
        if(empty($user)) {
            return redirect(route('users.index'))->with('info', 'Registro no encontrado');
        }
        return view('admin.users.show', compact('user','acta'));
    }
    
    public function edit($id) {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $details = DB::table('user_details')->where('user_id',$id)->first();
        if(empty($user)) {
            return redirect(route('users.index'))->with('info', 'Registro no encontrado');
        }
        return view('admin.users.edit', compact('user','roles','details'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|unique:users,name,'.$user->id
        ]);
        User::find($user->id)->update([
            'name' => $request->name
        ]);
        $user->roles()->sync($request->roles);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:jpg,png|max:30000'
            ]); 
            $anterior = $user->details->profile_image ?? '';
            if($anterior !== '') {
                File::delete(public_path().'/usuarios/images/'.$anterior);
            }
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/usuarios/images', $filename);
        } else {
            $filename = 'sinimagen.png';
        }
        UserDetails::find($user->id)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'emergency_phone' => $request->emergency_phone,
            'emergency_contact' => $request->emergency_contact,
            'position' => $request->position,
            'profile_image' => $filename
        ]);
        return redirect()->route('users.index')->with('info', 'Usuario actualizado exitosamente');
    }

    public function deactivate(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->status = '0';
        $user->save();
        return redirect()->route('users.index')->with('info', 'Usuario desactivado');
    }

    public function activate(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->status = '1';
        $user->save();
        return redirect()->route('users.index')->with('info', 'Usuario activado');
    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required'
        ]);
        $user = User::findOrFail($request->user_id);
        $filename = $user->id . '-' . $request->dc . '.' . $request->file->getClientOriginalExtension();
        $EqFileName = $request->file->move(public_path() . '/usuarios/exp', $filename);
        UserFiles::create([
            'user_id' => $request->user_id,
            'document_name' => $filename,
            'document' => $request->dc
        ]);
        return redirect()->back()->with('info','Documento almacenado');
    }
}
