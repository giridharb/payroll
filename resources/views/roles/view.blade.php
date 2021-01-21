@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.users') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User List</a></li>
              <li class="breadcrumb-item active">User View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">      
        <div class="row">
        <div id="accordion" class="col-12">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0 card-title">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#personalInfo" aria-expanded="true" aria-controls="collapseOne">
                      Personal Information
                    </button>
                  </h5>
                </div>

                <div id="personalInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" id="formPersonalInformation" novalidate>
                      <div class="form-row">
                        <div class="form-group">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else. This is for our internal survey.</small>
                        </div>
                      </div>       
                          
                                
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputFirstName">First Name :</label>
                          {{$profile->first_name}}
                          
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMiddleName">Middle Name : </label>
                          {{$profile->middle_name}}                         
                        </div>
                        
                        <div class="form-group col-md-4">
                          <label for="inputLastName">Last Name :</label>  
                          {{$profile->last_name}}                        
                        </div>
                      </div>

                      <div class="form-row">

                        <div class="form-group col-md-4">
                          <label for="inputEmail">Email Address :</label>
                          {{$profile->email_address}}
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMobileNumber">Mobile Number :</label>
                          {{$profile->mobile_number}}
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAdharNumber">Aadhaar Number :</label>
                          {{$profile->aadhaar_number}}
                        </div>
                      </div>
                      <div class="form-row">
                       
                        <div class="form-group col-md-4">
                          <label for="inputDateofBirth">Date of Birth :</label>
                          {{$profile->date_of_birth}}
                          
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputGender">Gender :</label>
                          {{$profile->gender}}
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMarried">Marriage Status :</label>
                          {{$profile->married}}
                        </div>
                      </div>
                      <div class="form-row">    
                        <div class="form-group col-md-4">
                          <label for="inputHandicaped">Handicapped Status :</label>
                          {{$profile->handicapped->type ?? ''}}
                        </div>
                      </div>                      
                  </form>
                  </div>
                </div>
              </div>
            
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#addressInfo" aria-expanded="true" aria-controls="collapseOne">
                      Address Details
                    </button>
                  </h5>
                </div>

                <div id="addressInfo" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <form class="card-form needs-validation" id="formAddressInfo" novalidate>
                        
                     <div class="form-row">
                        <div class="form-group">
                          <small id="currentAddressInfo" class="form-text text-muted">Enter permanent adddress information</small>
                        </div>
                      </div> 
                      
                     @if($profile->address)
                      <div class="form-row">    
                            <div class="form-group col-md-4">
                                <label for="inputAddress">Address: </label>
                                {{$profile->address->address}}
                                
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputTown" id="lableTownVillage">Town/village:</label>
                                {{$profile->address->town->name}}
                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputTehsil" id="lableTehsil">Tehsil:</label>
                                {{$profile->address->tehsil->name}}
                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputDistrict"  id="lableDistrict">District:</label>
                                {{$profile->address->district->name}}                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State:</label>
                                {{$profile->address->state->name}}
                            
                            </div>
                            
                        </div>
                        @endif
                    </form>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#educationalQualificationsInfo" aria-expanded="true" aria-controls="collapseOne">
                    Educational Qualifications
                    </button>
                  </h5>
                </div>

                <div id="educationalQualificationsInfo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" id="formEducationalQualification" novalidate>
                       
                      <div class="form-row">
                        @if($profile->education)
                        <div class="form-group col-md-6">
                          <label for="inputQualification">Qualification :</label>
                          {{$profile->education->type}}                         
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                          <label for="inputQualificationDetails">Qualification Details:</label>
                          {{$profile->education_details}}
                          
                        </div>
                        
                      </div>
                      
                  </form>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#occupationInfo" aria-expanded="true" aria-controls="collapseOne">
                    Occupation Information
                    </button>
                  </h5>
                </div>

                <div id="occupationInfo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" id="formOccupationInfo" novalidate>
                       
                    
                      <div class="form-row">
                       @if($profile->occupation)
                        <div class="form-group col-md-6">
                          <label for="inputOccupation">Occupation :</label>
                          {{$profile->occupation->type}}
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                          <label for="inputOccupationDetails">Occupation Details :</label>
                          {{$profile->occupation_details}}
                        </div>
                        
                      </div>
                      
                  </form>
                  </div>
                </div>
              </div>

              @if($profile->documents)
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#documentList" aria-expanded="true" aria-controls="collapseOne">
                    List of Documents
                    </button>
                  </h5>
                </div>

                <div id="documentList" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">

                    <form class="card-form needs-validation" id="formDocumentList" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                          <small id="emailHelp" class="form-text text-muted">You have following documents ( पुढील कागदपत्रे आपल्या जवळ  आहेत )</small>
                        </div>
                      </div> 

                      <div class="form-row">                       
                        @foreach ($profile->documents as $document)
                        <div class="form-group col-md-3">
                            <div class="form-check">
                             <label class="form-check-label" for="gridCheck">{{ucwords($document->type->type)}}</label>
                            </div>
                          </div>
                        @endforeach
                      </div>
                      
                  </form>
                  </div>
                </div>
              </div>
               @endif
            
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#propertyDetails" aria-expanded="true" aria-controls="collapseOne">
                    Property Details
                    </button>
                  </h5>
                </div>

                <div id="propertyDetails" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">

                    <form class="card-form needs-validation" id="formPropertyDetails" novalidate>
                   
                      <div class="form-group ">
                          <label for="numbers_of_acres_own_land">How many acres of land you have in your name?( आपल्या नावे किती एकर जमीन आहे? ):</label>
                          {{$profile->numbers_of_acres_own_land}}
                         
                        </div>

                      <div class="form-group ">
                        <label for="inputOwnHouse">Do you own a house? (तुमचे घर आहे का?):</label>
                        {{$profile->you_own_house}}
                      </div>
                    
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label for="inputOwnCar">Do you own a car? (आपल्याकडे कार आहे का?):</label>
                              {{$profile->you_own_car}}
                          </div>
                       
                          <div class="form-group col-md-6">
                            <label for="inputPayIncomeTax">Do you pay income tax? (आपण आयकर भरता का?):</label>
                            {{$profile->pay_income_tax}}
                           
                          </div>
                      </div>
                  </form>
                  </div>
                </div>
              </div>

                @if($profile->family)
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#familyDetails" aria-expanded="true" aria-controls="collapseOne">
                    Family Details
                    </button>
                  </h5>
                </div>

                <div id="familyDetails" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">

                    <form class="card-form needs-validation" id="formFamilyDetails" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                          <small id="emailHelp" class="form-text text-muted">This information is required to generate genealogy. ( वंशावळ निर्माण करण्यासाठी ही माहिती आवश्यक आहे )</small>
                        </div>
                      </div> 

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="mother_name">Mother Name :</label>
                          {{$profile->family->mother_name}}
                        </div>
                        <div class="form-group col-md-6">
                          <label for="mother_adhar_number">Mother's Adhar Number :</label>
                          {{$profile->family->mother_aadhaar_name}}
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="father_name">Father Name</label>
                          {{$profile->family->father_name}}
                        </div>
                        <div class="form-group col-md-6">
                          <label for="father_adhar_number">Father's Adhar Number</label>
                          {{$profile->family->father_aadhaar_number}}
                        </div>
                      </div>

                      <div class="form-row" id="spouseDetails" @if($profile->family->spouse_name==null)style="display: none;" @endif>
                        <div class="form-group col-md-6">
                          <label for="spouse_name">Spouse Name</label>
                          {{$profile->family->spouse_name}}
                        </div>
                        <div class="form-group col-md-6">
                          <label for="spouse_adhar_number">Spouse's Aadhaar Number</label>
                          {{$profile->family->spouse_aadhaar_number}}
                        </div>
                      </div>

                     
                  </form>
                  </div>
                </div>
              </div>
                @endif
                <input type="hidden" id="profile_id" value="{{$profile->id}}">
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection