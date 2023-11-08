<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Termómetro</title>
    <style>
        @page {
            size:  7.0in 5.0in;
            margin: 5px 5px 5px 5px;
        }
          
          a {
            color: #5D6975;
            text-decoration: underline;
          }
          
          body {
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
          }
          
          header {
            padding: 10px 0;
            margin-bottom: 30px;
          }
          
          #logo {
            text-align: center;
            margin-bottom: 10px;
          }
          
          #logo img {
            width: 90px;
          }
          
          h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
          }
          
          #project {
            float: left;
          }
          
          #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
          }
          
          #company {
            float: right;
            text-align: right;
          }
          
          #project div,
          #company div {
            white-space: nowrap;        
          }
          
          table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
          }
          
          table tr:nth-child(2n-1) td {
            background: #F5F5F5;
          }
          
          table th,
          table td {
            text-align: center;
          }
          
          table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
          }
          
          table .service,
          table .desc {
            text-align: left;
          }
          
          table td {
            padding: 20px;
            text-align: right;
          }
          
          table td.service,
          table td.desc {
            vertical-align: top;
          }
          
          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
          }
          
          table td.grand {
            border-top: 1px solid #5D6975;;
          }
          
          #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
          }
          
          footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
          }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img width="20px" src="data:image/png;base64,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9Pf08/fz8vby8fXx8PXx7/Tw7vPv7fPu7PLt6/Hs6vHr6fDq6O/p5+/o5u7n5e3m5O3l4+zk4uvj4evj4Ori3+nh3ung3ejf3Ofe2+fd2ubc2eXb2OXa1+TZ1uPY1ePX1OLW0+HV0uHV0eDU0N/Tz9/Szt7Rzd3QzN3Py9zOytvNydvMyNrLx9nKxtnJxdjIxNfHw9fHwtbGwdXFwNXEv9TDvtPCvdPBvNLAu9G/utG+udC9uM+8t8+7ts66tc25tMy4ssu3scu2sMq1r8m0rsmzrciyrMexq8ewqsavqcWuqMWtp8SspsOrpcOrpMKqo8Kpo8GposGoocCnoL+mn7+lnr6knb2jnLyhmrugmbufmLqel7mdlrmdlbiclLebk7eakraZkbWYkLWXj7SWjrOVjbOUjLKTi7GSirGRibCQiK+Ph6+Phq6Oha2NhK2Mg6yLgquKgauJgKqIf6mHfqmGfaiGfaiFfKeEe6eDeqaCeaWBeKWBd6SAdqN/daN+dKJ9c6F8cqF7caB6cJ95b594bp53bZ12bJ11a5x0aptzaZtzaJpyZ5lxZplwZZhvZJduY5dtYpZsYZVrYJVqX5RpXpNoXZNnXJJmW5FlWpFlWZBkWI9jV49iVo5hVY1gVI1fU4xeUotdUYtcUIpbT4laTolZTYhYTIdXS4dXSoZWSYVVSIVUR4RTRoNSRYNRRIJQQ4FPQoFOQYBNQH9MP39LPn5KPX1JPH1JO3xIOntHOXtGOHpFN3lENnlDNXhCNHdBM3dAMnY/MXU+MHU9L3Q8LnM7LXM7LHI6K3E5KnE4KXA3KG82J281Jm40JW0zJG0yI2wxImswIWsvIGouH2ktHmktHWgsHGcrG2cqGmYpGWUoGGUnF2QmFmMlFWMkFGIjE2EiEmEhEWAgEF8fD18fDl4eDV0dDF0cC1wbClsaCVsZCFoYB1kXBlkWBVgVBFcUA1cTAlYSAVURAAAAAIV5XisAAAEAdFJOU////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wBT9wclAAAACXBIWXMAAC4jAAAuIwF4pT92AAAgAElEQVR4nO2dd3xP1//HTyKJIDZVWxGKGkFtEiOV1AgidszYxEhRYseoInatIGbtFSN2zKqaX4raNWrFDkIi+X0SgnDv+973+567/D7PP779PnLveZ8jr9x7z3gPuxLFmQDX4oV+CpAuM7KBFQWst/MeIvRzh1ikoc4zOYzGikzy2+k9AisUrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmymxymZKrLKZEqtspsQqmyn5fyfbm0dPnkY9exkdHR3LbG1tHRwdHNOlS5c+k63eA0Px/0W2+1f+vXXz5u17kY/jBK/bZsiSNUeOHLnyFcyq8chIfPGyvb549szZy1eeStwW9/Dhhbf/L11+5yJFihZ2UH1kSviSZYs+fuLE8b9jkK2enjxp+V/7wqVKli2bRo1h8eBLle3G/j/+PIVV7CNizpxZwmyLlq/oWoDfoPjxJcr2YPfuPRd4GIo7c2Yey16tuvs3PKzx5EuTLXZv+J6TwrMOIrdXrGD5a3rWcuJpVClflGwvw9dtfqSG4StX5qZ0reOVRw3bJL4c2R5tXL/jhXrmX23f3rtMQ+9C6vWA4QuRLXbrok2v1O4k/ujRwFJNmxvhmfsiZDux6Pd7GnV18uSgKq2bpNWoN1HML9uzBfNOa9lf/P79vRq1d9Oyy88xu2wXpi2M0rzTF0uWfNu5dUbN+/2AqWWL3zJtB7ZiGSfO9xnUzL+kPn0zU8v2et6kSzp2/3LBArfe9Wz06dy0sr2cM/4/vccQEVEooHVKPXo2qWxRM4Pv6j2GBC50Hta7mw77J6aU7fmkyQ/1HkMSd37+tY+/5gsCE8r2Zs5IQzxpSTwcEty3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" alt="">
      </div>
      <h1>ETIQUETA DE IDENTIFICACIÓN</h1>
      <div id="company" class="clearfix">
      </div>
      <div>
        <p style="font-size:18px"><strong>Termometro: </strong> {{ $thermometer->name }}</p>
        <p style="font-size:18px"><strong>Clave: </strong> {{ $thermometer->code }}</p>
        <p style="font-size:18px"><strong>Situación: </strong> {{ ($thermometer->status == 0 ? 'Baja' : $thermometer->status == 1) ? 'En uso' : 'En mantenimiento'}}
            @if($thermometer->status == 'En uso')
                <span id="circlegreen"></span>
            @elseif($thermometer->status == 'En reparación')
                <span id="circleyellow"></span>
            @else
                <span id="circlered"></span>
            @endif
        </p>
        @if($thermometer->prevent1 == '2000-01')
        @else
            <p style="font-size:18px"><strong>Calibración: </strong>{{ $thermometer->calibration }}</p>
        @endif
        <p style="font-size:18px"><strong>Contacto para mantenimiento </strong><br>{{ $thermometer->provider->name }}<br>{{ $thermometer->provider->phone }}</p>
      </div>
    </header>
  </body>
</html>