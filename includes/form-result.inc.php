<?php
$escape = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};

echo '<main class="form-result-main">
  <section class="form-result-card" aria-labelledby="form-result-heading">
    <h2 id="form-result-heading">' . $escape($resultHeading) . '</h2>';

if ($errors) {
    echo '<div class="form-result-status form-result-status--error" role="alert">
      <strong>Please check your submission</strong>
      <ul>';
    foreach ($errors as $error) {
        echo '<li>' . $escape($error) . '</li>';
    }
    echo '</ul></div>';
} else {
    echo '<div class="form-result-status form-result-status--success" role="status">
      <strong>Details received</strong>
    </div>
    <dl class="form-result-details">';
    foreach ($resultRows as $row) {
        echo '<div class="form-result-field"><dt>' . $escape($row['label']) . '</dt><dd>';
        $value = $escape($row['value']);
        echo !empty($row['multiline']) ? nl2br($value) : $value;
        echo '</dd></div>';
    }
    echo '</dl>';
}

echo '<div class="form-result-actions">
  <a class="form-result-primary" href="' . $escape($backHref) . '">Back to form</a>
</div>
  </section>
</main>';
