module.exports = {
    apps: [
      {
        name: "laravel-worker",
        script: "artisan",
        args: "queue:work --sleep=3 --tries=3 --max-time=3600",
        interpreter: "php",
        instances: 1,      // No uses 'max' para colas, satura el CPU
        autorestart: true,
        watch: false,
        max_memory_restart: "200M", // Evita fugas de memoria que afectan a Apache
        exec_mode: "fork"
      }
    ]
  };
