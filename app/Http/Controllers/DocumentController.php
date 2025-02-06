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
    // Show the form for creating a new document
    public function create()
    {
        $documentTypes = [
            'Medical Certificate',
            'Medical Clearance',
            'Annual Medical Clearance',
            'Excuse Letter',
            'Waiver',
            'Waiver for Pulmonary Case',
            'DMDC Consent Form',
        ];

        return view('documents.create', compact('documentTypes'));
    }

    // Store a new document
    public function store(Request $request)
    {

        // Create a new document
        switch ($request->document_type) {
            case 'Excuse Letter':
                $request->validate([
                    'phone_number' => 'required|string|max:255',
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'excuse_for' => 'required|string|max:255',
                    'cause' => 'required|string|max:255',
                    'doctorName' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'date_today' => 'required|date',
                    
                ]);
                break;
    
            case 'Medical Clearance':
                $request->validate([
                    'date' => 'required|date',
                    'patient_name' => 'nullable|string|max:255',
                    'vaccination_status' => 'required|string|max:255',
                    'remarks' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    'license_number' => 'required|string|max:255',
                ]);
                break;
    
            case 'Medical Certificate':
                $request->validate([
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'clearance_type' => 'required|string|max:255',
                    'sickness' => 'required|string|max:255',
                    'startDate' => 'required|date',
                    'endDate' => 'required|date',
                    'reason' => 'required|string|max:255',
                    'doctorName' => 'required|string|max:255',
                ]);
                break;
            
            case 'Annual Medical Clearance':
                $request->validate([
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'startDate' => 'required|date',
                    'endDate' => 'required|date',
                    'doctorName' => 'required|string|max:255',
                    'license_number' => 'required|string|max:255',
                ]);
                break;
            
            case 'Waiver':
                $request->validate([
                    'date' => 'required|date',
                    'patient_name' => 'required|string|max:255',
                    'doctorName' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                ]);
                break;
            
            case 'Waiver for Pulmonary Case':
                $request->validate([
                    'patient_name' => 'required|string|max:255',
                    'collegeName' => 'required|string|max:255',
                    'department' => 'required|string|max:255',
                    'diagnosedDate' => 'required|date',
                    'diagnosedIllness' => 'required|string|max:255',
                    'followUpDate' => 'required|date',
                ]);
                break;
            
            case 'DMDC Consent Form':
                $request->validate([
                    'event_name' => 'required|string|max:255',
                ]);
                break;
                
        switch ($request->document_type) {
            case 'Excuse Letter':
                ExcuseLetter::create([
                    'document_id' => $document->id,
                    'phone_number' => $request->phone_number,
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'excuse_for' => $request->excuse_for,
                    'cause' => $request->cause,
                    'doctorName' => $request->doctorName,
                    'address' => $request->address,
                    'date_today' => $request->date_today,
                ]);
                break;
    
            case 'Medical Clearance':
                MedicalClearance::create([
                    'document_id' => $document->id,
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'vaccination_status' => $request->vaccination_status,
                    'remarks' => $request->remarks,
                    'position' => $request->position,
                    'license_number' => $request->license_number,
                ]);
                break;
    
            case 'Medical Certificate':
                MedicalCertificate::create([
                    'document_id' => $document->id,
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'clearance_type' => $request->clearance_type,
                    'sickness' => $request->sickness,
                    'startDate' => $request->startDate,
                    'endDate' => $request->endDate,
                    'reason' => $request->reason,
                    'doctorName' => $request->doctorName,
                ]);
                break;
    
            case 'Annual Medical Clearance':
                AnnualMedicalClearance::create([
                    'document_id' => $document->id,
                    'date' => $request->date,
                    'patient_name' => $request->patient_name,
                    'startDate' => $request->startDate,
                    'endDate' => $request->endDate,
                    'doctorName' => $request->doctorName,
                    'license_number' => $request->license_number,
                ]);
                break;
            
            case 'Waiver':
                Waiver::create([
                    'document_id' => $document->id,
                    'date' => $request->date,
                    'name' => $request->name,
                    'collegeName' => $request->collegeName,
                    'department' => $request->department,
                    'diagnosedDate' => $request->diagnosedDate,
                    'diagnosedIllness' => $request->diagnosedIllness,
                    'followUpDate' => $request->followUpDate,
                ]);
                break;
            
            case 'Waiver for Pulmonary Case':
                WaiverForPulmonaryCase::create([
                    'document_id' => $document->id,
                    'patient_name' => $request->patient_name,
                    'collegeName' => $request->collegeName,
                    'year' => $request->year,
                    'followUpDate' => $request->followUpDate,
                ]);
                break;
            
                
        }
        // Redirect back to the document index with a success message
        return redirect()->route('documents.adocument_file')->with('success', 'Document created successfully!');
    }
}

    // Show all documents
    public function adocument_file(Request $request)
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

        $query = Document::with(['excuseletter', 'medicalCertificate', 'medicalClearance', 'annualMedicalClearance', 'waiver', 'waiverForPulmonaryCase', 'dmdcConsentForm']); 

        if ($request->has('document_type') && $request->input('document_type') !== null) {
            $typeFilter = $request->input('document_type');
            $query->where('document_type', $typeFilter);
        }

        $documents = $query->get();
        return view('documents.adocument_file', compact('documents', 'typeOptions'));
    }

    // Show the form to edit a specific document
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

            // Add cases for other document types here...
        }

        return view('documents.edit', compact('document', 'associatedDocument'));
    }

    // Update a specific document
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        // Validate the request
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'doctorName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Update the document
        $document->update($request->all());

        // Update the associated document type
        switch ($document->document_type) {
            case 'Excuse Letter':
                $document->excuseletter->update($request->all());
                break;

            case 'Medical Certificate':
                $document->medicalCertificate->update($request->all());
                break;

            case 'Medical Clearance':
                $document->medicalClearance->update($request->all());
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

        return redirect()->route('documents.adocument_file')->with('success', 'Document updated successfully!');
    }

    // Show a specific document
    public function show($id)
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
        }

        return view('documents.show', compact('document', 'associatedDocument'));
    }
}