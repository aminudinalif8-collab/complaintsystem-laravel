<?php

namespace App\Http\Controllers\clerk;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

use App\Models\Complaint;
use App\Models\Employee;

class ClerkEditComplaintController extends Controller
{
    /**
     * Delete file from Cloudinary by extracting public_id from URL
     */
    private function deleteCloudinaryFile($cloudinaryUrl)
    {
        try {
            // Extract public_id from Cloudinary URL
            // URL format: https://res.cloudinary.com/[cloud]/image/upload/v[version]/[public_id].[ext]
            if (preg_match('/upload\/(?:v\d+\/)?(.+?)(?:\.\w+)?$/', $cloudinaryUrl, $matches)) {
                $publicId = $matches[1];
                
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('services.cloudinary.cloud_name'),
                        'api_key'    => config('services.cloudinary.api_key'),
                        'api_secret' => config('services.cloudinary.api_secret'),
                    ],
                ]);
                
                $cloudinary->uploadApi()->destroy($publicId);
            }
        } catch (\Exception $e) {
            // Log error but don't fail - old file deletion is not critical
            \Log::warning('Failed to delete Cloudinary file: ' . $e->getMessage());
        }
    }

    public function index($id)
    {
        $complaint = Complaint::where('complaintID', $id)
        ->where('employeeID', Auth::user()->employeeID)
        ->first();

        if (!$complaint) {
            abort(404);
        }

        $isEditable = $complaint->complaintStatus === 'Pending';

        $employee = Employee::find($complaint->employeeID);
        $supervisor = null;

        if ($employee && $employee->supervisorID) {
            $supervisor = Employee::find($employee->supervisorID);
        }

        $categories = Complaint::select('complaintCategory')
        ->distinct()
        ->pluck('complaintCategory');

        return view('clerk.clerkEditComplaints.clerkEditComplaint', compact('complaint', 'categories', 'employee', 'supervisor', 'isEditable'));
    }

    // UPDATE COMPLAINT
    public function update(Request $request, $id)
    {
        // 1. Get complaint (secure - hanya owner boleh edit)
        $complaint = Complaint::where('complaintID', $id)
            ->where('employeeID', Auth::user()->employeeID)
            ->first();

        if (!$complaint) {
            abort(404);
        }

        if ($complaint->complaintStatus !== 'Pending') {
            return redirect()
                ->route('clerk.myComplaintsClerk')
                ->with('error', 'You cannot edit this complaint because it is already being processed.');
        }

        // 2. Validation
        $request->validate([
            'complaintTitle' => 'required|string|max:255',
            'complaintDescription' => 'required|string',
            'complaintCategory' => 'required|string',
            'complaintEvidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf,txt|max:5120'
        ]);

        // 3. Update basic fields
        $complaint->complaintTitle = $request->complaintTitle;
        $complaint->complaintDescription = $request->complaintDescription;
        $complaint->complaintCategory = $request->complaintCategory;

        // 4. Handle file upload
        if ($request->hasFile('complaintEvidence')) {
            // Delete old file from Cloudinary if it exists
            if ($complaint->complaintEvidence) {
                $this->deleteCloudinaryFile($complaint->complaintEvidence);
            }

            try {
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('services.cloudinary.cloud_name'),
                        'api_key'    => config('services.cloudinary.api_key'),
                        'api_secret' => config('services.cloudinary.api_secret'),
                    ],
                ]);

                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('complaintEvidence')->getRealPath(),
                    [
                        'folder' => 'complaints'
                    ]
                );

                $uploadedFileUrl = $uploadedFile['secure_url'] ?? null;

                if (!$uploadedFileUrl) {
                    return redirect()
                        ->back()
                        ->with('error', 'Failed to upload file to Cloudinary.');
                }

                $complaint->complaintEvidence = $uploadedFileUrl;
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->with('error', 'File upload failed: ' . $e->getMessage());
            }
        }

        // 5. Save
        $complaint->save();

        // 6. Redirect
        return redirect()
            ->route('clerk.myComplaintsClerk')
            ->with('success', 'Complaint updated successfully');
    }

    // CANCEL COMPLAINT
    public function cancelComplaint($id)
    {
        $complaint = Complaint::where('complaintID', $id)
            ->where('employeeID', Auth::user()->employeeID)
            ->first();

        if (!$complaint) {
            abort(404);
        }

        // only pending can cancel
        if ($complaint->complaintStatus !== 'Pending') {

            return redirect()
                ->route('clerk.myComplaintsClerk')
                ->with('error', 'Only pending complaints can be cancelled.');
        }

        // update status
        $complaint->complaintStatus = 'Cancelled';
        $complaint->save();

        return redirect()
            ->route('clerk.myComplaintsClerk')
            ->with('success', 'Complaint cancelled successfully.');
    }
}
