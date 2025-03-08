<?php
interface NotificationInterface
{
   public function send(string $title, string $message);
}
class EmailNotification implements NotificationInterface
{
   private $adminEmail;

   public function __construct(string $adminEmail)
   {
      $this->adminEmail = $adminEmail;
   }

   public function send(string $title, string $message): void
   {
      echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.";
   }
}
class SlackApi
{

   public function __construct(private string $login, private string $apiKey)
   {
   }

   public function logIn(): void
   {
      // Send authentication request to Slack web service.
      echo "Logged in to a slack account '{$this->login}'.\n";
   }

   public function sendMessage(string $chatId, string $message): void
   {
      // Send message post request to Slack web service.
      echo "Posted following message into the '$chatId' chat: '$message'.\n";
   }
}
class SlackNotificationAdapter implements NotificationInterface
{

    public function __construct(private SlackApi $slack, private string $chatId)
    {
    }

    /**
     * An Adapter is not only capable of adapting interfaces, but it can also
     * convert incoming data to the format required by the Adaptee.
     */
    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

$notification = new EmailNotification("developers@example.com");
$notification->send("mail title", "mail message");
echo PHP_EOL;


$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotificationAdapter($slackApi, 'chartid');
$notification->send("slack title", "slack message");
echo PHP_EOL;