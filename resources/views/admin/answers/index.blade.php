@extends('layouts.admin')
@section('content')
  <header class="admin-content__header u-bg-white">
    <div class="admin-content__header-mast u-flex-center">
      <h2 class="admin-content__header-title"> Answers </h2>
      <div class="admin-content__header-actions">
        <div class="admin-content__date-group sch-group">
            <a href="javascrip:void(0)" data-toggle="modal" data-target="#addAnswerModal" class="btn btn-green">Add Answer</a>
          </div>
        </div>
      </div>
    </header>
    <main class="admin-content__body">
      <section class="admin-content__section">
        <div class="admin-content__section-header">
          <div class="ques-info">
            <h3 class="admin-content__section-headline">Explore data of all Answers</h3>
          </div>
        </div>
        
          <div class="table-main-scroll"><table class="admin-content__table ad-table3 ad-table2 no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
              <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Company Name : activate to sort column ascending"> Answer</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th></tr>
            </thead>
            <tbody>
            @foreach($answers as $answer)
            <tr class="clickable-row odd" role="row">
                <td>
                    <a href="javascrip:void(0)" onclick='deleteAns({{ $answer->id }})'><i aria-hidden="true" class="fa fa-times-circle"></i></a>
                </td>
                <td>{{$answer->answer}}</td>
                <td>
                    <a href="javascrip:void(0)" onclick='editAns({{ $answer->id }}, "{{$answer->answer}}")'><i aria-hidden="true" class="fa fa-caret-right"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
        
      </section>

    </main>



<!-- Add Modal -->
<div id="addAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="{{ route('manageAnswersStore') }}">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Answer</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="question_id" value="{{Request::segment(4)}}" />
        <div class="form-group">
          <label for="answer">Answer:</label>
          <textarea rows="4" class="form-control" name="answer" id="answer" required></textarea>
        </div>
        <button style="color:green;" type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<button style="display:none;" id="edit-answer-modal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editAnswerModal">Open Modal</button>
<div id="editAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="{{ route('manageAnswersUpdate') }}">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Answer</h4>
        </div>
        <div class="modal-body">
        <input id="answer-id" type="hidden" name="ans_id" />
        <div class="form-group">
          <label for="answer">Answer:</label>
          <textarea id="answer-text" rows="4" class="form-control" name="answer" id="answer" required></textarea>
        </div>
        <button style="color:green;" type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete Modal -->
<button style="display:none;" id="delete-answer-modal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deleteAnswerModal">Open Modal</button>
<div id="deleteAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="{{ route('manageAnswersDelete') }}">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Answer</h4>
        </div>
        <div class="modal-body">
        <p>Do you want to delete the selected answer?</p>
        <input id="answer-id-delete" type="hidden" name="ans_id" />
        <button style="color:green;" type="submit" name="submit" value="yes" class="btn btn-default">Yes</button>
        <button style="color:gray;" type="submit" name="submit" value="no" class="btn btn-default">No</button>
        </div>
      </div>
    </form>
  </div>
</div>
    @endsection