<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-size: 13px;
        }
        h3 {
            width: 100%;
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }

        .border-b {
            border-bottom: 1px solid #000;
        }

        .border-b-detail {
            border-bottom: 1px dotted #000;
        }

        .pl-30 {
            padding-left: 30px;
        }

        .italic {
            font-style: italic;
        }

        .col1 {
            width: 5%;
        }

        .col2 {
            width: 60%;
        }

        .col3 {
            width: 35%;
        }

        .w-full {
            width: 100%;
        }

        .mb-10 {
            margin-bottom: 10px;
        }
        .font-12 {
            font-size: 12px;
        }

        .w-50 {
            width: 50%;
        }

        .align-top{
            vertical-align: top
        }
    </style>
</head>
<body>
    @if(isset($data))
        <h3>
            Đơn thuốc
        </h3>
        <table class="w-full">
            <tr>
                <td class="w-50 align-top">
                    <div>
                        Họ và tên : <span class="bold">{{$data->Patient ? $data->Patient->name : ''}}</span>
                    </div>
                    <div>
                        Chuẩn đoán : <span class="bold">{{$data->result}}</span>
                    </div>
                </td>
                <td class="w-50 align-top">
                    <div>
                        Ngày sinh: {{$data->Patient ? $data->Patient->date : ''}}
                        &emsp;
                        giới tính:
                        @if($data->Patient)
                            @if ($data->Patient->sex == 0)
                                Nam
                            @else
                                Nữ
                            @endif
                        @endif
                    </div>
                    <div>
                        Sdt: {{$data->Patient ? $data->Patient->phone : ''}}
                    </div>
                </td>
            </tr>
        </table>

        <div class="border-b pl-30 mb-10">
            Mạch: {{$data->circuit}} lần/p&emsp;&emsp;Nhiệt Độ: {{$data->T}} C&emsp;&emsp;Huyết áp: {{$data->HA}} &emsp;&emsp;Câng nặng: {{$data->weight}} Kg
        </div>

        <div>
            <span class="border-b">
                Bác sĩ: Hoàng Tấn Cường
            </span>
        </div>

        <div class="mb-10">
            @if($data->Prescription)
                @foreach ($data->Prescription->PrescriptionDetail as $index=>$item)
                    <div class="border-b-detail">
                        <table class="w-full">
                            <tr>
                                <td class="bold col1">{{$index + 1}}.</td>
                                <td class="italic col2">{{$item->Drug->name}}</td>
                                <td class="col3">
                                    {{$item->quantity}}
                                    @if ($item->Drug && $item->Drug->DrugUnit)
                                        {{$item->Drug->DrugUnit->name}}
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <span class="bold">
                            &emsp;&emsp;{{$item->dosage}}
                        </span>
                        -({{$item->number_of_day}}ngày)

                    </div>
                @endforeach
            @endif
        </div>
        <div class="mb-10">
            Lời dặn của bác sĩ: {{$data->result4}}
        </div>
        <div>
            <table style="width:100%">
                <tr>
                    <td style="vertical-align: top; font-size: 12px; width:50%">
                        * Khám lại nhớ mang theo đơn thuốc này
                    </td>
                    <td style="text-align: center; vertical-align: top; width:50%">
                        <div class="font-12 italic">
                            Toa cấp ngày&emsp;&emsp; tháng &emsp;&emsp; năm 20
                        </div>
                        <div class="bold">
                            Bác sĩ khám bệnh
                        </div>
                        <br><br><br>
                        <div class="bold">
                            Bác sĩ da liễu
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    @endif
</body>
</html>
