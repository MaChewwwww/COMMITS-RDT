<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ExcuseLetter;
use App\Models\MedicalCertificate;
use App\Models\MedicalClearance;
use App\Models\AnnualMedicalClearance;
use App\Models\Waiver;
use App\Models\WaiverForPulmonaryCase;
use App\Models\DMDCConsentForm;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create(Request $request)
    {
        // Retrieve the document type from the route defaults
        $documentType = $request->route('document_type');

        // Map document types to their corresponding views
        $views = [
            'Excuse Letter' => 'documents.excuse_letter.create',
            'Medical Clearance' => 'documents.medical_clearance.create',
            'Medical Certificate' => 'documents.medical_certificate.create',
            'Annual Medical Clearance' => 'documents.annual_medical_clearance.create',
            'Waiver' => 'documents.waiver.create',
            'Waiver for Pulmonary Case' => 'documents.waiver_for_pulmonary_case.create',
            'DMDC Consent Form' => 'documents.dmdc_consent_form.create',
        ];

        // Check if the document type exists in the view mapping
        if (!array_key_exists($documentType, $views)) {
            return redirect()->route('documents.index')->with('error', 'Invalid document type.');
        }

        // Render the corresponding create view
        return view($views[$documentType], compact('documentType'));
    }


    public function store(Request $request)
    {
        $document_type = $request->input('document_type');
        //dd($request->document_type); // This will output the document type

        // Validate common fields first
        $request->validate([
            'document_type' => 'required|string|max:255',
        ]);

        // Create the document record
        $document = Document::create([
            'document_type' => $document_type,
        ]);

        //dd($request->all()); //debugging

        // Validation and data insertion based on document type
        switch ($document_type) {
            case 'Excuse Letter':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'excuse_for' => 'required|string|max:255',
                    'cause' => 'required|string|max:255',
                    'doctorName' => 'required|string|max:255',
                    'recipient' => 'required|string|max:255',
                    'department' => 'required|string|max:255',
                ]);

                ExcuseLetter::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'excuse_for' => $request->excuse_for,
                    'cause' => $request->cause,
                    'doctorName' => $request->doctorName,
                    'recipient' => $request->recipient,
                    'department' => $request->department,
                ]);
                break;

                case 'Medical Clearance':
                    $request->validate([
                        'document_type' => 'required|string|max:255',
                        'date' => 'required|date',
                        'patient_name' => 'nullable|string|max:255',
                        'vaccination_status' => 'required|string|max:255',
                        'excuse' => 'required|string|max:255',
                        'doctorName' => 'required|string|max:255',
                        'position' => 'required|string|max:255',
                        'license_number' => 'required|string|max:255',
                        'xray_result' => 'nullable|string|max:255',
                        'additional_date' => 'nullable|date',
                        'additional_patient_name' => 'nullable|string|max:255',
                        'additional_vaccination_status' => 'nullable|string|max:255',
                        'additional_excuse' => 'nullable|string|max:255',
                        'additional_doctorName' => 'nullable|string|max:255',
                        'additional_position' => 'nullable|string|max:255',
                        'additional_license_number' => 'nullable|string|max:255',
                ]);

                MedicalClearance::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'vaccination_status' => $request->vaccination_status,
                    'excuse' => $request->excuse,
                    'doctorName' => $request->doctorName,
                    'position' => $request->position,
                    'license_number' => $request->license_number,
                    'xray_result' => $request->xray_result,
                    'additional_date' => $request->additional_date,
                    'additional_patient_name' => $request->additional_patient_name,
                    'additional_vaccination_status' => $request->additional_vaccination_status,
                    'additional_excuse' => $request->additional_excuse,
                    'additional_doctorName' => $request->additional_doctorName,
                    'additional_position' => $request->additional_position,
                    'additional_license_number' => $request->additional_license_number,
                ]);

                break;

            // Repeat for the other cases...
            case 'Medical Certificate':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'sickness' => 'required|string|max:255',
                    'startDate' => 'required|date',
                    'endDate' => 'required|date',
                    'reason' => 'required|string|max:255',
                    'doctorName' => 'required|string|max:255',
                    'additional_date' => 'nullable|date',
                    'additional_patient_name' => 'nullable|string|max:255',
                    'additional_sickness' => 'nullable|string|max:255',
                    'additional_startDate' => 'nullable|date',
                    'additional_endDate' => 'nullable|date',
                    'additional_reason' => 'nullable|string|max:255',
                    'additional_doctorName' => 'nullable|string|max:255',

                ]);

                MedicalCertificate::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'clearance_type' => $request->clearance_type,
                    'sickness' => $request->sickness,
                    'startDate' => $request->startDate,
                    'endDate' => $request->endDate,
                    'reason' => $request->reason,
                    'doctorName' => $request->doctorName,
                    'additional_date' => $request->additional_date,
                    'additional_patient_name' => $request->additional_patient_name,
                    'additional_sickness' => $request->additional_sickness,
                    'additional_startDate' => $request->additional_startDate,
                    'additional_endDate' => $request->additional_endDate,
                    'additional_reason' => $request->additional_reason,
                    'additional_doctorName' => $request->additional_doctorName,
                ]);
                break;

            case 'Annual Medical Clearance':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'excuseDate' => 'required|date',
                    'doctorName' => 'required|string|max:255',
                    'license_number' => 'required|string|max:255',
                    'additional_date' => 'nullable|date',
                    'additional_patient_name' => 'nullable|string|max:255',
                    'additional_excuse_date' => 'nullable|date',
                    'additional_doctorName' => 'nullable|string|max:255',
                    'additional_license_number' => 'nullable|string|max:255',
                ]);

                AnnualMedicalClearance::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'excuseDate' => $request->excuseDate,
                    'doctorName' => $request->doctorName,
                    'license_number' => $request->license_number,
                    'additional_date' => $request->additional_date,
                    'additional_patient_name' => $request->additional_patient_name,
                    'additional_excuse_date' => $request->additional_excuse_date,
                    'additional_doctorName' => $request->additional_doctorName,
                    'additional_license_number' => $request->additional_license_number,
                ]);
                break;

            case 'Waiver':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'date' => 'required|date',
                    'name' => 'required|string|max:255',
                    'collegeName' => 'required|string|max:255',
                    'department' => 'required|string|max:255',
                    'diagnosedDate' => 'required|date',
                    'diagnosedIllness' => 'required|string|max:255',
                    'followUpDate' => 'required|date',
                    'doctorName' => 'required|string|max:255',
                    'additional_date' => 'nullable|date',
                    'additional_name' => 'nullable|string|max:255',
                    'additional_collegeName' => 'nullable|string|max:255',
                    'additional_department' => 'nullable|string|max:255',
                    'additional_diagnosedDate' => 'nullable|date',
                    'additional_diagnosedIllness' => 'nullable|string|max:255',
                    'additional_followUpDate' => 'nullable|date',
                    'additional_doctorName' => 'nullable|string|max:255',
                ]);

                Waiver::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'date' => $request->date,
                    'name' => $request->name,
                    'collegeName' => $request->collegeName,
                    'department' => $request->department,
                    'diagnosedDate' => $request->diagnosedDate,
                    'diagnosedIllness' => $request->diagnosedIllness,
                    'followUpDate' => $request->followUpDate,
                    'doctorName' => $request->doctorName,
                    'additional_date' => $request->additional_date,
                    'additional_name' => $request->additional_name,
                    'additional_collegeName' => $request->additional_collegeName,
                    'additional_department' => $request->additional_department,
                    'additional_diagnosedDate' => $request->additional_diagnosedDate,
                    'additional_diagnosedIllness' => $request->additional_diagnosedIllness,
                    'additional_followUpDate' => $request->additional_followUpDate,
                    'additional_doctorName' => $request->additional_doctorName,
                ]);
                break;

            case 'Waiver for Pulmonary Case':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'patient_name' => 'required|string|max:255',
                    'collegeName' => 'required|string|max:255',
                    'year' => 'required|string|max:255',
                    'followUpDate' => 'required|date',
                    'date' => 'required|date',
                    'additional_date' => 'nullable|date',
                    'additional_patient_name' => 'nullable|string|max:255',
                    'additional_collegeName' => 'nullable|string|max:255',
                    'additional_year' => 'nullable|string|max:255',
                    'additional_followUpDate' => 'nullable|date',
                ]);

                WaiverForPulmonaryCase::create([
                    'document_type' => $request->document_type,
                    'document_id' => $document->id, // link document_id
                    'patient_name' => $request->patient_name,
                    'collegeName' => $request->collegeName,
                    'department' => $request->department,
                    'year' => $request->year,
                    'followUpDate' => $request->followUpDate,
                    'date' => $request->date,
                    'additional_patient_name' => $request->additional_patient_name,
                    'additional_collegeName' => $request->additional_collegeName,
                    'additional_department' => $request->additional_department,
                    'additional_year' => $request->additional_year,
                    'additional_date' => $request->additional_date,
                    'additional_followUpDate' => $request->additional_followUpDate,
                ]);
                break;

            case 'DMDC Consent Form':
                $request->validate([
                    'document_type' => 'required|string|max:255',
                    'event_name' => 'required|string|max:255',
                ]);

                DMDCConsentForm::create([
                    'document_id' => $document->id, // link document_id
                    'event_name' => $request->event_name,
                ]);
                break;
        }


        $view = 'documents.' . strtolower(str_replace(' ', '_', $document_type)) . '.view';
        return redirect()->route($view, ['id' => $document->id])->with('success', 'Document created successfully!');
    }

    public function view($id, $documentSlug)
    {
        $document = Document::find($id);

        if (!$document) {
            return redirect()->route('documents.index')->with('error', 'Document not found!');
        }

        // Mapping of document types to models
        $documentTypeModels = [
            'excuse_letter' => ExcuseLetter::class,
            'medical_clearance' => MedicalClearance::class,
            'medical_certificate' => MedicalCertificate::class,
            'annual_medical_clearance' => AnnualMedicalClearance::class,
            'waiver' => Waiver::class,
            'waiver_for_pulmonary_case' => WaiverForPulmonaryCase::class,
            'dmdc_consent_form' => DMDCConsentForm::class,
        ];

        $documentSlug = strtolower(str_replace(' ', '_', $document->document_type));

        $viewName = 'documents.' . $documentSlug . '.view';

        // Get the model based on document_type
        $modelClass = $documentTypeModels[$documentSlug] ?? null;

        if ($modelClass) {
            $specificDocument = $modelClass::where('document_id', $id)->first();

            if (!$specificDocument) {
                return redirect()->route('documents.index')->with('error', 'Specific document not found!');
            }
        } else {
            return redirect()->route('documents.index')->with('error', 'Invalid document type!');
        }

        // Pass the specific document ID along with data
        return view($viewName, [
            'document' => $document,
            'specificDocument' => $specificDocument,
            'specificDocumentId' => $specificDocument->id
        ]);
    }

    public function index(Request $request)
    {
        $typeOptions = [
            'Medical Certificate',
            'Medical Clearance',
            'Annual Medical Clearance',
            'Excuse Letter',
            'Waiver',
            'Waiver for Pulmonary Case',
            'DMDC Consent Form',
        ];

        $MonthOptions = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $query = Document::with([
            'excuseletter',
            'medicalCertificate',
            'medicalClearance',
            'annualMedicalClearance',
            'waiver',
            'waiverForPulmonaryCase',
            'dmdcConsentForm'
        ]);

        $documents = Document::whereNull('deleted_at')->get();


        // Filter by document type
        if ($request->filled('document_type')) {
            $query->where('document_type', $request->input('document_type'));
        }

        // Filter by month (ensure it's a valid number)
        if ($request->filled('month') && is_numeric($request->input('month'))) {
            $query->whereMonth('created_at', (int) $request->input('month'));
        }

        // Filter by week if provided
        if ($request->filled('week')) {
            $query->whereRaw('WEEK(created_at, 1) = ?', [$request->input('week')]);
        }

        $documents = $query->get();

        return view('documents.index', compact('documents', 'typeOptions', 'MonthOptions'));
    }



    public function edit($id)
    {
        $document = Document::findOrFail($id);

        // Fetch the associated document type based on the document_type
        switch ($document->document_type) {
            case 'Excuse Letter':
                $associatedDocument = $document->excuseletter;
                break;

            case 'Medical Certificate':
                $associatedDocument = $document->medicalCertificate;
                break;

            case 'Medical Clearance':
                $associatedDocument = $document->medicalClearance;
                break;

            case 'Annual Medical Clearance':
                $associatedDocument = $document->annualMedicalClearance;
                break;

            case 'Waiver':
                $associatedDocument = $document->waiver;
                break;

            case 'Waiver for Pulmonary Case':
                $associatedDocument = $document->waiverForPulmonaryCase;
                break;

            case 'DMDC Consent Form':
                $associatedDocument = $document->dmdcConsentForm;
                break;

            default:
                // Handle unknown document types (optional)
                throw new \Exception("Unknown document type: {$document->document_type}");
        }
        // Dynamically construct the view path based on the document_type
        $viewPath = 'documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.edit';

        return view($viewPath, compact('document', 'associatedDocument'));
    }

// Update a specific document
public function update(Request $request, $id)
{
    $document = Document::findOrFail($id);

    //dd($request->all()); //debugging
    // Validate the request based on document type
    switch ($document->document_type) {
        case 'Excuse Letter':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'date' => 'required|date',
                'patient_name' => 'required|string|max:255',
                'excuse_for' => 'required|date',
                'cause' => 'required|string|max:255',
                'doctorName' => 'required|string|max:255',
                'recipient' => 'required|string|max:255',
                'department' => 'required|string|max:255',
            ]);
            break;

        case 'Medical Clearance':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'date' => 'required|date',
                'patient_name' => 'nullable|string|max:255',
                'vaccination_status' => 'required|string|max:255',
                'excuse' => 'required|string|max:255',
                'doctorName' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'license_number' => 'required|string|max:255',
                'xray_result' => 'nullable|string|max:255',
                'additional_date' => 'nullable|date',
                'additional_patient_name' => 'nullable|string|max:255',
                'additional_vaccination_status' => 'nullable|string|max:255',
                'additional_excuse' => 'nullable|string|max:255',
                'additional_doctorName' => 'nullable|string|max:255',
                'additional_position' => 'nullable|string|max:255',
                'additional_license_number' => 'nullable|string|max:255',
            ]);
            break;

        // Repeat for the other cases...
        case 'Medical Certificate':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'date' => 'required|date',
                'patient_name' => 'required|string|max:255',
                'sickness' => 'required|string|max:255',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'reason' => 'required|string|max:255',
                'doctorName' => 'required|string|max:255',
                'additional_date' => 'nullable|date',
                'additional_patient_name' => 'nullable|string|max:255',
                'additional_sickness' => 'nullable|string|max:255',
                'additional_startDate' => 'nullable|date',
                'additional_endDate' => 'nullable|date',
                'additional_reason' => 'nullable|string|max:255',
                'additional_doctorName' => 'nullable|string|max:255',

            ]);
            break;

        case 'Annual Medical Clearance':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'date' => 'required|date',
                'patient_name' => 'required|string|max:255',
                'excuseDate' => 'required|date',
                'doctorName' => 'required|string|max:255',
                'license_number' => 'required|string|max:255',
                'additional_date' => 'nullable|date',
                'additional_patient_name' => 'nullable|string|max:255',
                'additional_excuse_date' => 'nullable|date',
                'additional_doctorName' => 'nullable|string|max:255',
                'additional_license_number' => 'nullable|string|max:255',
            ]);
            break;

        case 'Waiver':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'date' => 'required|date',
                'name' => 'required|string|max:255',
                'collegeName' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'diagnosedDate' => 'required|date',
                'diagnosedIllness' => 'required|string|max:255',
                'followUpDate' => 'required|date',
                'doctorName' => 'required|string|max:255',
                'additional_date' => 'nullable|date',
                'additional_name' => 'nullable|string|max:255',
                'additional_collegeName' => 'nullable|string|max:255',
                'additional_department' => 'nullable|string|max:255',
                'additional_diagnosedDate' => 'nullable|date',
                'additional_diagnosedIllness' => 'nullable|string|max:255',
                'additional_followUpDate' => 'nullable|date',
                'additional_doctorName' => 'nullable|string|max:255',
            ]);
            break;

        case 'Waiver for Pulmonary Case':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'patient_name' => 'required|string|max:255',
                'collegeName' => 'required|string|max:255',
                'year' => 'required|string|max:255',
                'followUpDate' => 'required|date',
                'date' => 'required|date',
                'additional_date' => 'nullable|date',
                'additional_patient_name' => 'nullable|string|max:255',
                'additional_collegeName' => 'nullable|string|max:255',
                'additional_year' => 'nullable|string|max:255',
                'additional_followUpDate' => 'nullable|date',
            ]);

            break;

        case 'DMDC Consent Form':
            $request->validate([
                'document_type' => 'required|string|max:255',
                'event_name' => 'required|string|max:255',
            ]);
            break;
    }


    // Update the associated document type
    switch ($document->document_type) {
        case 'Excuse Letter':
            $document->excuseletter->update($request->all());
            break;

        case 'Medical Clearance':
            $document->medicalClearance->update($request->all());
            break;

        case 'Medical Certificate':
            $document->medicalCertificate->update($request->all());
            break;

        case 'Annual Medical Clearance':
            $document->annualMedicalClearance->update($request->all());
            break;

        case 'Waiver':
            $document->waiver->update($request->all());
            break;

        case 'Waiver for Pulmonary Case':
            $document->waiverForPulmonaryCase->update($request->all());
            break;

        case 'DMDC Consent Form':
            $document->dmdcConsentForm->update($request->all());
            break;
    }

    $view = 'documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.edit';

    return redirect()->route($view, ['id' => $document->id])->with('success', 'Document updated successfully!');
}

public function softDelete($id)
{
    $document = Document::findOrFail($id);
    $document->delete();

    return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
}


}
