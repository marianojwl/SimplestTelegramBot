# SimplestTelegramBot - A Simple PHP Telegram Bot

This is a simple PHP Telegram bot that responds to commands and messages. It uses the Telegram Bot API to receive and send messages. You can customize its behavior and responses by editing the `webhook.php` and `SimplestTelegramBot.php` files as needed.

## Prerequisites

Before you can use this PHP Telegram bot, make sure you have the following:

1. A Telegram bot token: You need to create a bot on Telegram and obtain its API token. You can get one by talking to [BotFather](https://core.telegram.org/bots#botfather).

2. PHP environment: Ensure that you have PHP installed on your server or local development environment.

## Installation

1. Clone or download this repository to your local machine or server.

2. Create a `.env` file in the project root directory and add your Telegram bot token as follows:

```plaintext
TELEGRAM_TOKEN=your_bot_token_here
SUPPORT_USER=your_support_username_here
```

Replace your_bot_token_here with your actual bot token and your_support_username_here with the username of the support user you want to link in the /soporte command.

Customize the bot's behavior by editing the webhook.php and SimplestTelegramBot.php files. You can change the command responses, add new commands, and modify the language file (lang/es.json) to suit your needs.

## Usage

To use this Telegram bot, follow these steps:

1. **Deployment**:
   - Deploy your PHP application to a web server or host it locally using a tool like [ngrok](https://ngrok.com/) for testing.

2. **Webhook Setup**:
   - Set up a publicly accessible URL for your `webhook.php` file. This URL should be in the format `https://yourdomain.com/webhook.php`.

3. **Configure Webhook**:
   - Use the Telegram Bot API to set the webhook URL for your bot. You can use the following cURL command, replacing `YOUR_BOT_TOKEN` and `YOUR_WEBHOOK_URL` with your bot's token and the URL you created:
     ```shell
     curl -F "url=YOUR_WEBHOOK_URL" "https://api.telegram.org/botYOUR_BOT_TOKEN/setWebhook"
     ```

4. **Start Bot**:
   - Once the webhook is set up, your bot should respond to commands and messages on Telegram.

### Commands

This bot currently supports the following commands:

- `/start`: Sends a welcome message.
- `/soporte`: Provides a link to contact support.
- Any other text input: Responds with a default message or custom responses based on the input.

### Customization

You can customize the bot's behavior by editing the `webhook.php` file. You can add new commands, change the responses, or modify the language file to suit your requirements.

### Logs

The bot logs last incoming and outgoing messages in the `log` directory for testint. You can find received messages in `log/data.txt` and sent message results in `log/sendMessageResult.txt`.
