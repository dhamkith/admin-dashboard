@component('mail::message') 
<div style="box-sizing: border-box;background-color: #161627;color: #8e9195;padding: 1rem; border-bottom: 6px solid #0084ff; border-radius: 6px 6px 0 0;">
  <h1 style="box-sizing: border-box; color: #8e9195; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">wellcome  : {{$user->name}} </h1>
  <p style="box-sizing: border-box; color: #8e9195; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Thaks for signing up.
    <strong style="box-sizing: border-box;">We really appreciate</strong> it. Let us
    <em style="box-sizing: border-box;">know if we can</em> do more to please you!
  </p>
</div> 
<div style="box-sizing: border-box; background-color: #121220; color: #8e9195; padding: .618rem 1rem 1.618rem; border-radius: 0;">
  <div style="box-sizing: border-box; display:block; max-width:100%; margin:0 auto;">
    <h4>The email address you signed up with is: <span style="font-weight:400; margin-left:0.6rem; color: #0084ff ;">{{$user->email}}</span></h4>
  </div>
  <div style="box-sizing: border-box;display:block;
        width:100%;">
    <div style="box-sizing: border-box; display:block; max-width:200px; margin: 2rem auto 0;">
      <a href="{{config('app.url')}}/dashboard"
          style="box-sizing: border-box;display:block;
          width:100%;
          margin-bottom: calc(1.618rem - 1px);
          background-color: #0084ff ;
          border-color: #0084ff ;
          border-width: 1px;
          color:  #fff;
          cursor: pointer; 
          padding-bottom: calc(0.61rem - 1px); 
          padding-top: calc(0.61rem - 1px);
          text-align: center;
          text-decoration:none;
          white-space: nowrap;
          padding-left: 2.618rem;
          padding-right: 2.618rem;
          border-radius: 1.618rem;
          box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);">visit</a>
    </div>
  </div>  
</div>

<div style="box-sizing: border-box;background-color: #161627;color: #8e9195;padding: 1rem; border-radius: 0 0 6px 6px ;"> 
  <span style="box-sizing: border-box; color: #8e9195;">Thanks,</span><br>
  <span style="box-sizing: border-box; color: #8e9195;">{{ config('app.name') }}</span>
</div>
@endcomponent  
 