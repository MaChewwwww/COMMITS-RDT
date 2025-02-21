<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ExcuseLetter;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Show all documents with their associated excuse letters
    public function index(Request $request)
    {
        // Define the document type options
        $typeOptions = [
            'Medical Certificate',
            'Medical Clearance',
            'Annual Medical Clearance',
            'Excuse Letter',
            'Waiver',
            'Waiver for Pulmonary Case',
            'DMDC Consent Form',
        ];
    
        // Initialize the query to fetch documents with the correct relationship
        $query = Document::with('excuseletter'); // Use the correct relationship name
    
        // Check if the request contains the 'document_type' parameter
        if ($request->has('document_type') && $request->input('document_type') !== null) {
            $typeFilter = $request->input('document_type');
    
            // Validate the document_type filter
            $request->validate([
                'document_type' => 'nullable|string|in:Medical Certificate,Medical Clearance,Annual Medical Clearance,Excuse Letter,Waiver,Waiver for Pulmonary Case,DMDC Consent Form',
            ]);
    
            // Apply the document_type filter to the query
            $query->where('document_type', $typeFilter);
        }
    
        // Execute the query to fetch documents
        $documents = $query->get();
    
        // Pass the data to the view
        return view('documents.index', compact('documents', 'typeOptions'));
    }

    // Show the form to edit a specific document's excuse letter
    public function edit($id)
    {
        // Fetch the excuse letter using the document_id
        $excuseLetter = ExcuseLetter::where('document_id', $id)->firstOrFail();
    
        // Pass the excuse letter to the edit view
        return view('documents.edit', compact('excuseLetter'));
    }
    

    // Update the excuse letter associated with a document
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'excuse_for' => 'required|string|max:255', // Changed to string
            'cause' => 'required|string|max:255',
            'doctorName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        

        // Find the document and its associated excuse letter
        $document = Document::findOrFail($id);
        $excuseLetter = $document->excuseletter;

        // Update the excuse letter fields
        $excuseLetter->update($request->all());

        // Redirect back to the document index with a success message
        return redirect()->route('documents.index')->with('success', 'Excuse Letter updated successfully!');
    }
    public function show($id)
    {
        // Fetch the document by its ID
        $document = Document::findOrFail($id);
    
        // Fetch the associated excuse letter for the document
        $excuseletter = $document->excuseletter; // Make sure the variable name matches
    
        // Pass the excuse letter and document id to the view
        return view('documents.view', compact('excuseletter', 'id'));
    }
    
    
}