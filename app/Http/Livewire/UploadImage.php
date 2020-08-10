<?php
 
namespace App\Http\Livewire;
 
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Image;
 
class UploadImage extends Component
{
    use WithFileUploads;
 
    public $image;
 
    public function render()
    {
        return view('livewire.upload-image');
    }
   
    public function submit()
    {
        $validatedData = $this->validate([
            'image' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024',
        ]);
 
        $imageName = $this->image->store("images",'public');
 
        $validatedData['title'] = $imageName;
 
        Image::create($validatedData);
   
        session()->flash('message', 'Image has been successfully Uploaded.');
 
        return redirect()->to('/laravel-livewire-upload-image');
    }
 
}