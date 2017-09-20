<h1>Welcome to JumpNotes!</h1>
<p>Hi, Admin</p>
<p>There is a new query on from your site JUMPNOTES</p>
<table border="2px" class="bordered">
  <tr>
    <td>
      <b>FIRST NAME</b>
    </td>
    <td>
      <b>LAST NAME</b>
    </td>
    <td>
      <b>EMAIL</b>
    </td>
    <td>
      <b>MESSAGE</b>
    </td>
  </tr>
  <tr>
    <td>
      {{$request['f_name']}}
    </td>
    <td>
      {{$request['l_name']}}
    </td>
    <td>
      {{$request['email']}}
    </td>
    <td>
      {{$request['message']}}
    </td>
  </tr>
</table>
