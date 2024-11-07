<?php

namespace App\Services\Whatsapp;

use App\ChatStepsEnum;
use App\Jobs\SendWhatsappMessage;
use App\Models\ChatStep;
use App\Models\User;
use App\Services\Complaint\Contracts\StoreCompliantServiceContract;
use App\Services\Whatsapp\Contracts\WhatsappServiceContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WhatsappService implements Contracts\WhatsappServiceContract
{
    public function __construct(
        private readonly ChatStep                      $chatStep,
        private readonly StoreCompliantServiceContract $storeComplaintService,
        private readonly User                          $user
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(array $data): mixed
    {
        try {
            $phone = $data['phone'];
            $message = $data['text'];
            DB::beginTransaction();

            $chat = $this->chatStep->firstOrCreate([
                'phone' => $phone,
            ], [
                'phone' => $phone,
                'step' => ChatStepsEnum::START,
            ]);

            Log::info(json_encode($data));


            $user = $this->user->firstWhere('email', config('biospot.whatsapp_user_email'));
            if ($chat->step === ChatStepsEnum::START) {

                $this->updateChat($chat, ChatStepsEnum::CREATED_COMPLAINT, null);
                DB::commit();
                SendWhatsappMessage::dispatch($phone, json_encode($this->handleMessage(__('messages.whatsapp.start'), $phone)));
                return __('messages.whatsapp.start');
            } else {
                $messageData = explode(';', $message['message']);
                $complaint = $this->storeComplaintService->execute([
                    'description' => $messageData[0],
                    'address' => [
                        'full_address' => $messageData[1],
                    ]
                ], $user->id);

                $this->updateChat($chat, ChatStepsEnum::START, $complaint);
                DB::commit();
                SendWhatsappMessage::dispatch($phone, json_encode($this->handleMessage(__('messages.whatsapp.created_complaint'), $phone)));
                return __('messages.whatsapp.created_complaint');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            SendWhatsappMessage::dispatch($phone, json_encode($this->handleMessage(__('messages.whatsapp.error'), $phone)));
            return $exception;
        }
    }

    private function updateChat(mixed $chat, string $status, mixed $complaint)
    {
        tap($chat, function ($model) use ($status, $complaint) {
            return $model->update([
                'step' => $status,
                'complaint_id' => $complaint ? $complaint->id : null
            ]);
        });
    }

    /**
     * @param string $message
     * @param string $phone
     * @return string[]
     */
    private function handleMessage(string $message, string $phone): array
    {
        return [
            'message' => $message,
            'phone' => $phone
        ];
    }
}
