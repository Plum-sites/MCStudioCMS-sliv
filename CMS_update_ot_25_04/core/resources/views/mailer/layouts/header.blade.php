<tr>
    <td class="container">
        <table>
            <tr>
                <td align="center" class="masthead">
                    <h1 style="color:#fff;">
                        {{ @$general->title }}
                    </h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2>
                        Привет {{ @$user->username }}!
                    </h2>
                    <p>
                        <?php echo @$data_text; ?>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>