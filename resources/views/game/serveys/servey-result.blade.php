<div class="header2">
@extends('layouts.game')
</div>
@section('content')
<div class="game-wrapper">
    <!--game-wrapper--->
    <div class="row">
        <div class="col-lg-12">
            <!--custom chart start-->
            <div class="border-head">
                <h3>Thank you for your answer.</h3>
            </div>
            <div class="custom-bar-chart">
                <ul class="y-axis">
                    <li>
                        <span>100</span>
                    </li>
                    <li>
                        <span>80</span>
                    </li>
                    <li>
                        <span>60</span>
                    </li>
                    <li>
                        <span>40</span>
                    </li>
                    <li>
                        <span>20</span>
                    </li>
                    <li>
                        <span>0</span>
                    </li>
                </ul>
                <?php $i = 0; ?>
                @foreach($serveyResults as $result)
                    <div class="bar">
                        <div class="value tooltips" data-original-title="{{ (count($result->serveyAnswers) / $answered)*100 }}%" data-toggle="tooltip" data-placement="top" style="height: {{ (count($result->serveyAnswers) / $answered)*100 }}%; background-color:{{ $colorArrays[$i] }};" onclick='resultDetail("{{$result->answer}}", {{ $answered}}, {{ (count($result->serveyAnswers) / $answered)*100 }})'></div>
                     </div>
                    <?php $i++; ?>
                @endforeach
                @if($questionDetails->allowed_other_answer == 1)
                    <div class="bar">
                        <div class="value tooltips" data-original-title="{{ ($otherAnswersCount / $answered)*100 }}%" data-toggle="tooltip" data-placement="top" style="height: {{ ($otherAnswersCount / $answered)*100 }}%; background-color:#ff00bf;" onclick='resultDetail("Other Answer", {{ $answered}}, {{ ($otherAnswersCount / $answered)*100 }})'></div>
                    </div>
                @endif
            </div>
            <!--custom chart end-->
            <div class="view-notify">
                <div class="col-md-6">
                    <label class="pull-right">
                        <span>Answered:</span>
                        <span></span>
                        <span>{{ $answered }}</span>
                    </label>
                </div>
                <div class="col-md-6">
                    <label class="pull-left">
                        <span>Skipped:</span>
                        <span></span>
                        <span>{{ $skipped }}</span>
                    </label>
                </div>
            </div>
            <table class="table">
                <?php $j = 0; ?>
                @foreach($serveyResults as $result)
                    <tr>
                        <td><span style="background-color:{{ $colorArrays[$j] }};"></span></td>
                        <td>{{ $result->answer }}</td>
                        <td>{{ (count($result->serveyAnswers) / $answered)*100 }}%</td>
                        <td>{{ count($result->serveyAnswers) }}</td>
                    </tr>
                    <?php $j++; ?>
                @endforeach
                <tr>
                    <td><span style="background-color:#ff00bf;"></span></td>
                    <td>Other Answer</td>
                    <td>{{ ($otherAnswersCount / $answered)*100 }}%</td>
                    <td>{{ $otherAnswersCount }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total Respondents</td>
                    <td></td>
                    <td>{{ $answered }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>


 <!-- Modal -->
 <button style="display:none;" id="answer-details-servey-modal" type="button" data-toggle="modal" data-target="#serveyResultDetailPopup"></button>
  <div id="serveyResultDetailPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <h2 id="ans-name-servey"></h2>
            <p id="total-answered-servey"></p><br />
            <p id="total-percentage-servey"></p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
  </div>
</div>
@endsection