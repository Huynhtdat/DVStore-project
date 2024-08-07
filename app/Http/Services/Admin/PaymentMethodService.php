<?php

namespace App\Http\Services\Admin;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\UpdatePaymentMethodRequest;
use App\Models\Payment;
use App\Repository\Eloquent\PaymentRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentMethodService
{
    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * PaymentService constructor.
     *
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get list payments
        $list = $this->paymentRepository->all();
        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Tên PT Thanh Toán',
                    'key' => 'name',
                ],
                [
                    'text' => 'Trạng thái',
                    'key' => 'status',
                    'status' => [
                        [
                            'text' => 'Hoạt động',
                            'value' => Payment::STATUS['active'],
                            'class' => 'badge badge-success'
                        ],
                        [
                            'text' => 'Vô hiệu hóa',
                            'value' => Payment::STATUS['unactive'],
                            'class' => 'badge badge-danger'
                        ],
                    ],
                ],
                [
                    'text' => 'Hình ảnh',
                    'key' => 'img',
                    'img' => [
                        'url' => 'asset/imgs/',
                        'style' => 'width: 60px;'
                    ],
                ],
            ],
            'actions' => [
                'text'          => "Chức năng",
                'create'        => false,
                'createExcel'   => false,
                'edit'          => true,
                'deleteAll'     => false,
                'delete'        => false,
                'viewDetail'    => false,
            ],
            'routes' => [
                'edit' => 'admin.payments_edit',
            ],
            'list' => $list,
        ];

        return [
            'title' => TextLayoutTitle("payment_method"),
            'tableCrud' => $tableCrud,
        ];
    }

    public function edit(Payment $payment)
    {
        try {
            // Fields form
            $status = [
                [
                    'text' => 'Hoạt động',
                    'value' => 1,
                ],
                [
                    'text' => 'Vô hiệu hóa',
                    'value' => 0,
                ]
            ];
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Tên PT Thanh toán',
                    'type' => 'text',
                    'value' => $payment->name,
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Trạng thái',
                    'type' => 'select',
                    'value' => $payment->status,
                    'list' => $status
                ],
                [
                    'attribute' => 'img',
                    'label' => 'Hình ảnh',
                    'type' => 'file',
                    'value' => $payment->img,
                ],
            ];

            //Rules form
            $rules = [
                'name' => [
                    'required' => true,
                    'minlength' => 1,
                    'maxlength' => 100,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => "Vui lòng nhập tên pương thức thanh toán",
                    'minlength' => "Phương thức thanh toán có tối thiểu 1 ký tự",
                    'maxlength' => "Phương thức thanh toán có tối đa 100 ksy tự",
                ],
            ];

            return [
                'title' => TextLayoutTitle("edit_payment"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
                'payment' => $payment,
            ];
        } catch (Exception) {
            return [];
        }

    }

    public function update(UpdatePaymentMethodRequest $request, Payment $payment)
    {
        try {
            $data = $request->validated();
            if ($request->img) {
                $imageName = time().'.'.request()->img->getClientOriginalExtension();
                request()->img->move(public_path('asset/imgs'), $imageName);
                $data['img'] = $imageName;
            }
            $this->paymentRepository->update($payment, $data);

            return redirect()->route('admin.payments_index')->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            return redirect()->route('admin.payments_index')->with('error', TextSystemConst::UPDATE_FAILED);
        }
    }

}
?>
