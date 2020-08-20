                      <table class="table table-dark">
                                    <thead>
                                      <tr>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Fill NAME</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Sub totsl</th>
                                        <th scope="col">total</th>
                                        <th scope="col">CREATED AT</th>

                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>

                                        <td>{{$order_info->id}}</td>
                                        <td>{{$order_info->full_name}}</td>
                                        <td>{{$order_info->address}}</td>
                                        <td>{{$order_info->sub_total}}</td>
                                        <td>{{$order_info->total}}</td>
                                        <td>{{$order_info->created_at->format('d/m/Y h:i:s A')}}</td>


                                      </tr>



                                    </tbody>
                                  </table>
