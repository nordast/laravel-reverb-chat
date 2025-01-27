<?php

use Livewire\Volt\Component;
use App\Events\MessengerEvent;
use Livewire\Attributes\On;

new class extends Component {
    public string $message ='';
    public array  $messages = [];

    public function sendMessage()
    {
        // dispatch a message
        MessengerEvent::dispatch(Auth::user()->name, $this->message);
        $this->reset('message');
    }

    #[On('echo-private:messages,MessengerEvent')]
    public function onMessengerEvent($event)
    {
        // listen for message from the Event
        $this->messages[] = $event;
    }

};
?>

<div>
    <x-chat-dialog :messages="$this->messages" toMethod="sendMessage" name="Chat" />
</div>
